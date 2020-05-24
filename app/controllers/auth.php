<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: UNIVERSITY_LIBRARY/public/views/login.php");
exit(); }
?>