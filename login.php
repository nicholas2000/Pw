<?php 
    session_start();
    require_once("connection.php");

    if(isset($_REQUEST['btnLogin'])){
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $sql = "SELECT * FROM users";
        if($query = mysqli_query($conn, $sql)){
            $exist = false;
            $tempPassword;
            while($d = mysqli_fetch_array($query)){
                if($d['email'] == $email){
                    $exist = true;
                    $tempPassword = $d['password'];
                }
            }
            if($exist){
                if(password_verify($password, $tempPassword)){
                    $_SESSION['email'] = $email;
                    header("Location: home.php");
                }
                else{
                    echo "<script>alert('wrong password!')</script>";
                }
            }
            else{
                echo "<script>alert('email not found')</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="uni.css">
</head>
<body>
    <form action="#" method="post">
        <div style="font-size: 24pt;"><b>Login Page</b></div><br>
        email : <br>
        <input type="text" name="email" placeholder="input email"><br>
        password : <br>
        <input type="password" name="password" placeholder="input password"><br><br>
        <input type="submit" name="btnLogin" value="Login">
        <div>dont have an account? <a href="register.php">register here!</a></div>
    </form>
</body>
</html>