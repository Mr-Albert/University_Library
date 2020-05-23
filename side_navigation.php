
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="side_nav.css">

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="profile">profile</a>
  <a href="users">Users</a>
  <a href="books">Books</a>
  <a href="reg_reqs">Registration requests</a>
  <a href="Email">Emails</a>
</div>


<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>