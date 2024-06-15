<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['student_name'])){
    header('location:loginPage.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Teacher</title>
    <style>
        .logout-btn{
            width:25%;
            padding:10px 30px;
            cursor:pointer;
            display:block;
            margin:auto;
            background:linear-gradient(to right, #ff105f, #ffad06);
            border:0;
            outline:none;
            border-radius:30px;
            text-decoration:none;
            }
	
    </style>
</head>
<body>
    <h3>Hi, Students</h3>
    <h1>Welcome <span><?php echo $_SESSION['student_name'] ?></span></h1>
    <a href="login.php" class="logout-btn">Logout</a>
    
</body>
</html>