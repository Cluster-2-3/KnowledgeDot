<?php
    @include 'config.php';

    session_start();

    if(isset($_POST['submit'])){
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = md5($_POST['password']);
            $user_type = $_POST['user_type'];

            $select = " SELECT * FROM student_signup WHERE name = '$name' && password = '$password' ";

            $result = mysqli_query($conn, $select);

            if(mysqli_num_rows($result)>0){
               $row = mysqli_fetch_array($result);

               if($row['user_type'] == 'teacher'){
                    $_SESSION['teacher_name'] = $row['name'];
                    header('location:teachersPage.php');

               }elseif($row['user_type'] == 'student'){
                    $_SESSION['student_name'] = $row['name'];
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
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/loginStyle.css">
        <style>
            .toggle-btn,.active, .btn:hover {
                padding:10px 30px;
                cursor:pointer;
                background:transparent;
                border:0;
                position:relative;
                
                
            }

            .active{
				background-color:red;
			}
            
        </style>
	</head>
	<body>
	  <div class="main">
	    <!--create form outer box-->
		<div class="form-box">
			<div class="button-box">
				<div id="btn"></div>
				<button type="button" class="toggle-btn" onclick="login()"><a href="login.php" style="text-decoration:none;">Login</a></button>
				<button type="button" class="toggle-btn" onclick="signup()"><a href="signupPage.php" style="text-decoration:none;"> Signup</a></button>
			</div>
			<!--login form-->
			<form class="input-box" id="login" method="post" action="login.php">
            <?php 
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">' .$error.'</span>';
                        }
                    }
                
                
                ?>
				<input type="text" class="input-field" name="name" placeholder="Username" required>
				<input type="password" class="input-field" name="password"placeholder="Password" required>
				<input type="checkbox" class="check-box"><span>Remember Password</span>
                <input type="submit" name="submit" class="submit-btn" value="Login">
			</form>
			
			<div class="logo">
				<img src="images/logo.png">
				<h3>Knowledge Dot</h3>
			</div>
			
		</div>
	  </div>
	  
	  <script>
		var x = document.getElementById("login");
		var y = document.getElementById("signup");
		var z = document.getElementById("btn");
		
		function signup(){
			x.style.left="-400px";
			y.style.left="50px";
			z.style.left="110px";
		}
		
		function login(){
			x.style.left="50px";
			y.style.left="450px";
			z.style.left="0px";
		}
		
		
	  </script>
	</body>
</html>