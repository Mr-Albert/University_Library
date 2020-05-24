<?php
// // Enter your Host, username, password, database below.
// $con = mysqli_connect("localhost","root","","university_library");
// // Check connection
// if (mysqli_connect_errno())
//   {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   }
// else
// {
//   echo "connection successful";

// }  

$dsn = "mysql:host=localhost;dbname=university_library";
$user = "root";
$passwd = "";

try {
  $conn = new PDO($dsn, $user, $passwd);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
  echo "Failed to connect to DB";
}






// $stm = $pdo->query("SELECT VERSION()");

// $version = $stm->fetch();

// echo $version[0] . PHP_EOL;

?>