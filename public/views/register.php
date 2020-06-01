<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
<link rel="stylesheet" href="/UNIVERSITY_LIBRARY/public/css/login.css" />
<link href="/UNIVERSITY_LIBRARY/public/libs/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet"> <!--load all styles -->

</head>
<body>
<?php
if(!isset($_SESSION)) 
 { 
     session_start(); 
 } 
if(isset($_SESSION["username"])){
        session_start();

        header("Location: /UNIVERSITY_LIBRARY/index.php");
}

require('database/db.php');
// If form submitted, insert values into the database.
if (isset($_POST['userName'])){
        $userName = stripslashes($_REQUEST['userName']);
        $password = stripslashes($_REQUEST['password']);
        $email = stripslashes($_REQUEST['email']);
        $firstName = stripslashes($_REQUEST['firstName']);
        $lastName = stripslashes($_REQUEST['lastName']);
        $approved=1;
        $check_user_name_existance_query = "select count(*) from `users`  where user_name= '".$userName."'";
        $q_ptr = $conn->query($check_user_name_existance_query);
        $rows_num= $q_ptr->fetchAll(PDO::FETCH_NUM)[0][0];
        if($rows_num==0){
                if(isset($_POST['admin_privileges']) && $_POST['admin_privileges']=="on")
                {
                        $approved=0;
                

                $query = "insert into `users` (user_name,password,email,first_name,last_name,approved) values ('".$userName."',md5('".$password."'),'".$email."','".$firstName."','".$lastName."'".",".$approved.")";
                $q_ptr = $conn->query($query);
                
                $get_user_and_make_admin_query = " insert into users_groups (user_id,group_id) (select users.id as user_id,groups.id as group_id from users  join groups where group_name='admin' and user_name='".$userName."')" ;
                $q_ptr = $conn->query($get_user_and_make_admin_query);
                }
                else 
                {
                        $query = "insert into `users` (user_name,password,email,first_name,last_name,approved) values ('".$userName."',md5('".$password."'),'".$email."','".$firstName."','".$lastName."'".",".$approved.")";
                        $q_ptr = $conn->query($query);           
                        $get_user_and_make_admin_query = " insert into users_groups (user_id,group_id) (select users.id as user_id,groups.id as group_id from users  join groups where group_name='user' and user_name='".$userName."')" ;
                        $q_ptr = $conn->query($get_user_and_make_admin_query); 
                }
                header("Location: /UNIVERSITY_LIBRARY/public/views/login.php");

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

    <!-- Icon -->
    <div class="fadeIn first">
         <i class="fas fa-user"></i>  
    </div>

    <form  action="" method="post" name="registration">
        <input type="text" name="userName" class="fadeIn second" placeholder="User Name" required />
        <input type="text" name="firstName" class="fadeIn second" placeholder="First Name" required />
        <input type="text" name="lastName" class="fadeIn second" placeholder="Last Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <input id= "password" type="password" name="password" class="fadeIn third" placeholder="Password" onchange="validatePassword()" required />
        <input id="password_confirm" type="password" name="password_confirm" class="fadeIn third" placeholder="confirm password" onchange="validatePassword()" required />
        <input type="checkbox"  name="admin_privileges" id="admin_privileges">
        <label  for="admin_privileges">Request Admin privileges</label>
        <input type="submit" name="submit" value="Register" />
    </form>

    <div id="formFooter">
      <a class="underlineHover" href="/UNIVERSITY_LIBRARY/public/views/login.php">Back to login</a>
    </div>

  </div>
</div>
<?php } ?>
</body>
</html>