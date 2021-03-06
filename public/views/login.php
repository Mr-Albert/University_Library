<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="/UNIVERSITY_LIBRARY/public/css/login.css" />
<link href="/UNIVERSITY_LIBRARY/public/libs/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet"> <!--load all styles -->

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
  $query = "SELECT count(*),id FROM `users` WHERE user_name='$username'
  and password='".md5($password)."' and approved=1";
  $q_ptr = $conn->query($query);
  [$rows_num,$user_id]= $q_ptr->fetchAll(PDO::FETCH_NUM)[0];
  if($rows_num==1){
    $query = "update `users` set last_login=current_timestamp() WHERE user_name='$username'";
    $q_ptr = $conn->query($query);
    $_SESSION['username'] = $username;
    $_SESSION['userID'] = $user_id;

    $permissions_query = "
    select permission_name from permissions where permissions.id in (
    select permission_id  from groups_permissions where groups_permissions.group_id in (
    select group_id from users_groups where users_groups.user_id =(
    select id from users where user_name='".$username."')
    )
    )";
    $q_ptr = $conn->query($permissions_query);
    $rows= $q_ptr->fetchAll(PDO::FETCH_NUM);
    $_SESSION['permissions']=array();
    foreach ($rows as $row)
    {
      $_SESSION['permissions'][]=$row[0];
    }
    // Redirect user to index.php
	    header("Location: /UNIVERSITY_LIBRARY/index.php");
         }
      else{
        header("Location: login.php?wrong_credentials=true");
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
      <!-- <img src="public/assets/user_icon.svg" id="icon" alt="User Icon" /> -->
      <i class="fas fa-user"></i>  
      <?php if(isset($_GET["wrong_credentials"]) &&$_GET["wrong_credentials"]=="true") {?>
      <h style="color:red"> Wrong credentials<h>
      <?php }?>
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