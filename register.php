<?php 
    session_start();
    require_once("connection.php");

    if(isset($_REQUEST['btnRegister'])){
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $address = $_REQUEST['address'];
        $password = $_REQUEST['password'];
        $password2 = $_REQUEST['password2'];

        if($username != "" && $email != "" && $address != "" && $password != "" && $password2 != ""){
            $sql = "SELECT * FROM users";
            if($query = mysqli_query($conn, $sql)){
                $exist = false;
                while($d = mysqli_fetch_array($query)){
                    if($d['email'] == $email){
                        $exist = true;
                    }
                }
                if($exist){
                    echo "<script>alert('email has already been used')</script>";
                }
                else{
                    if($password == $password2){
                        $encrypted = password_hash($password, PASSWORD_DEFAULT);
                        $sql = mysqli_prepare($conn, "INSERT INTO users (name, password, email, address) VALUES(?, '$encrypted', ?, ?)");
                        mysqli_stmt_bind_param($sql, 'sss', $name, $email, $address);
                        mysqli_stmt_execute($sql);
                        echo "<script>alert('user registered')</script>";
                    }
                    else{
                        echo "<script>alert('failed to confirm password')</script>";
                    }
                }
            }
        }
        else{
            echo "<script>alert('please fill in all the fields')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="uni.css">
</head>
<body>
    <form action="#" method="post">
        <div style="font-size: 24pt;"><b>Register Page</b></div><br>
        name : <br>
        <input type="text" name="name" placeholder="input name"><br>
        email : <br>
        <input type="text" name="email" placeholder="input email"><br>
        address : <br>
        <input type="text" name="address" placeholder="input address"><br>
        password : <br>
        <input type="password" name="password" placeholder="input password"><br>
        confirm password : <br>
        <input type="password" name="password2" placeholder="input confirm password"><br><br>
        <input type="submit" value="Register" name="btnRegister">
        <div>already have an account? <a href="login.php">login here!</a></div>
    </form>
</body>
</html>