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
if (isset($_POST['username'])){
  // removes backslashes
	$username = stripslashes($_REQUEST['username']);
  //escapes special characters in a string
	$password = stripslashes($_REQUEST['password']);
	//Checking is user existing in the database or not
  $query = "SELECT count(*) FROM `users` WHERE user_name='$username'
  and password='".md5($password)."' and approved=1";
  $q_ptr = $conn->query($query);
  $rows_num= $q_ptr->fetchAll(PDO::FETCH_NUM)[0][0];
  if($rows_num==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: /UNIVERSITY_LIBRARY/index.php");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>
<link href="public/libs/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="public/libs/bootstrap-4.3.1/js/bootstrap.min.js"></script>
<script src="public/libs/jquery/jquery-3.5.1.min.js"></script>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="public/assets/user_icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="" method="post" name="login">
      <input type="text" name="username" class="fadeIn second" placeholder="Username" required />
      <input type="password" name="password" class="fadeIn third" placeholder="Password" required />
      <input name="submit" class="fadeIn fourth" type="submit" value="Login" />
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
    <a class="underlineHover" href="/UNIVERSITY_LIBRARY/public/views/register.php">Request Account?</a>
    </div>

  </div>
</div>
<?php } ?>
</body>
</html>