<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/admin.css">
    <title>Admin Login</title>
</head>

<body>
<?php

include("./config/config.php");
include("./config/warning.php");?>

<div class="form-box">
        <form action="admin.php" method="post">
            <div class="pcontainer">
                <p class="login-stats" id="login-stats">Login Failed</p>
        </div>
            
            
            <input type="text" name="email" class="email" placeholder="Enter Email">
            <br>
            <input type="password" name="password" class="password" placeholder="Enter Password">
            <br>
            <div class="login">
            <input type="submit" value="Login" class="loginb">
            </div>
        </form>
    </div>

    
        <?php
        $email = $_POST["email"];
        $password = $_POST["password"];
    
        // echo "<h1>Email is: $email Password is : $password</h1>"
        ?>
<?php
if(isset($email)){
$query = mysqli_query($connection,"select * from users");
while($row = mysqli_fetch_array($query)){
    if($email == $row['UMAIL'] && $password == $row['UPASSWD']){
        echo "<h1>Login Successful</h1>";
        header("Location: ../admin/index.php");
        
    }else if(!($email == $row['UMAIL']) && !($password == $row['UPASSWD'])){
        echo"
        <style>
        .login-stats{
        display:block;
        }
        </style>
        "; 
        
    }
}
$mysqli->close();
}
?>


</body>

</html>