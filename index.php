
<?php
//include auth.php file on all secure pages
include("./app/controllers/auth.php");
require('database/db.php');
$query = "select count(*) from users;";
$q_ptr = $conn->query($query);
$users_count=$q_ptr->fetchAll()[0][0];

$query = "select count(*) from books;";
$q_ptr = $conn->query($query);
$books_count=$q_ptr->fetchAll()[0][0];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<?php require('./public/views/top_navigation.php'); ?>
 

<div  style="margin-top:20%;margin-left:15%;margin-right:15%;background-color:rgb(163,215,229)">
    <h1 >
    <font color="white">Welcome to the university library we currently have 
    <font color="green"><?php echo $users_count?> users</font> and <font color="green"><?php echo $books_count?> books </font> </font> 
    </h1>
</div>
 </body>
</html> 
