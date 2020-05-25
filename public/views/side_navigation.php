
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/UNIVERSITY_LIBRARY/public/css/side_nav.css">

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  
  <?php if(in_array("users.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/users.php">Users</a>
  <?php } ?>

  <?php if(in_array("groups.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/groupss.php">Groups</a>
  <?php } ?>

  <?php if(in_array("permissions.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/permissions.php">Users</a>
  <?php } ?>

  <a href="/UNIVERSITY_LIBRARY/public/views/books.php">Books</a>
  
  <?php if(in_array("reg_reqs.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/reg_reqs.php">Registration requests</a>
  <?php } ?>

  <?php if(in_array("Email.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/Email.php">Emails</a>
  <?php } ?>

</div>


<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>