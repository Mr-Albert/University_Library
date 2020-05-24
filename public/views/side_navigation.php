
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/side_nav.css">

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="views/users.php">Users</a>
  <a href="views/books.php">Books</a>
  <a href="views/reg_reqs.php">Registration requests</a>
  <a href="views/Email.php">Emails</a>
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