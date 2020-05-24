<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="/UNIVERSITY_LIBRARY/public/css/login.css" />

</head>
<body>
<?php
require('database/db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['userName'])){
	$userName = stripslashes($_REQUEST['userName']);
        $password = stripslashes($_REQUEST['password']);
        $email = stripslashes($_REQUEST['email']);
        $firstName = stripslashes($_REQUEST['firstName']);
        $lastName = stripslashes($_REQUEST['lastName']);
        $check_user_name_existance_query = "select count(*) from `users`  where user_name= '".$userName."'";
        $q_ptr = $conn->query($check_user_name_existance_query);
        $rows_num= $q_ptr->fetchAll(PDO::FETCH_NUM)[0][0];
        if($rows_num==0){
                $query = "insert into `users` (user_name,password,email,first_name,last_name) values ('".$userName."',md5('".$password."'),'".$email."','".$firstName."','".$lastName."'".")";
                $q_ptr = $conn->query($query);
                //handle errors here <>
                echo "<div class='message'>
                <h3>Request submitted and pending approval.</h3>";
        }
        else {
                echo "<div class='form'>
                <h3>User name or password is unacceptable.</h3>
                <br/>Click here to <a href='register.php'>Register</a></div>";
                }
    }else{
?>
<link href="public/libs/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="public/libs/bootstrap-4.3.1/js/bootstrap.min.js"></script>
<script src="public/libs/jquery/jquery-3.5.1.min.js"></script>
<script>
        function validatePassword()
        {
                var password = document.getElementById("password")
                , password_confirm = document.getElementById("password_confirm");
                if(password.value != password_confirm.value) {
                        password_confirm.setCustomValidity("Passwords Don't Match");
        
        } else {
                password_confirm.setCustomValidity('');
                }
        }
</script>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="public/assets/user_icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form  action="" method="post" name="registration">
    <input type="text" name="userName" class="fadeIn second" placeholder="User Name" required />
    <input type="text" name="firstName" class="fadeIn second" placeholder="First Name" required />
    <input type="text" name="lastName" class="fadeIn second" placeholder="Last Name" required />
    <input type="email" name="email" placeholder="Email" required />
    <input id= "password" type="password" name="password" class="fadeIn third" placeholder="Password" onchange="validatePassword()" required />
    <input id="password_confirm" type="password" name="password_confirm" class="fadeIn third" placeholder="confirm password" onchange="validatePassword()" required />
    <input type="submit" name="submit" value="Register" />

    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
<?php } ?>
</body>
</html>