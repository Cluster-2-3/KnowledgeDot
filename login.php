<?php
    @include 'config.php';

    session_start();

    if(isset($_POST['submit'])){
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = md5($_POST['password']);
            $user_type = $_POST['user_type'];

            $select = " SELECT * FROM student_signup WHERE email = '$email' && password = '$password' ";

            $result = mysqli_query($conn, $select);

            if(mysqli_num_rows($result)>0){
               $row = mysqli_fetch_array($result);

               if($row['user_type'] == 'teacher'){
                    $_SESSION['teacher_email'] = $row['email'];
                    header('location:teachersPage.php');

               }elseif($row['user_type'] == 'student'){
                    $_SESSION['student_email'] = $row['email'];
                    header('location:studentPage.php');
               }
                
            }else{
                $error[] = "incorrect email or password!";
            }
    };
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Knowlede Dot</title>
        <link rel="icon" type="image/x-icon" href="images/titlelogo.ico">
		<link rel="stylesheet" type="text/css" href="css/loginStyle.css">         
	</head>
	<body>
		<div class="form-box1">
			<div class="logo">
				<img src="images/logo2.png">
				<h3>Knowledge Dot</h3>
			</div>	
			<h3 style="margin-left: 90px; font-family:Gilroy-Bold; font-weight:400px; margin-top:30px;" >Login</h3>
			<form  method="post" class="input-box" id="login">
				<label for="name" class="log-text"> Email</label><br>
				<input type="text" class="inputValue" name="email" placeholder="username@gmail.com" ><br>
				<label for="password" class="log-text"> Password</label><br>
				<input type="password" class="inputValue" name="password" placeholder="Password"><br>
				<a href = "#" class="link1"><p style="font-size:12px; color:white; margin:5px;margin-left:10px;">Forgot Password?</p></a>
		        <input type="submit" name="submit" id="submit-btn" value="SignIn">
			</form>	


		</div>
	  	
	</body>
</html>