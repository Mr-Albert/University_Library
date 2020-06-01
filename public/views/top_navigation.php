
<link rel="stylesheet" href="/UNIVERSITY_LIBRARY/public/css/top_nav.css">
<link rel="stylesheet" href="/UNIVERSITY_LIBRARY/public/libs/bootstrap-4.3.1/dist/css/bootstrap.css">

<link href="/UNIVERSITY_LIBRARY/public/libs/fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet"> <!--load all styles -->




<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<script src="/UNIVERSITY_LIBRARY/public/libs/jquery/jquery-3.5.1.min.js"></script>
<script src="/UNIVERSITY_LIBRARY/public/libs/bootstrap-4.3.1/dist/js/bootstrap.min.js" ></script>
<style>
.table-responsive{
  margin:1em;
}
</style>

<div class="topnav">
<a href="/UNIVERSITY_LIBRARY/public/views/logout.php">log out</a>
<a  href="/UNIVERSITY_LIBRARY/public/views/account.php">Account</a>

<?php if(in_array("expired_borrows.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/expired_borrows.php">Expired books borrow periods</a>
  <?php } ?>

<?php if(in_array("users.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/users.php">Users</a>
  <?php } ?>

  <?php if(in_array("groups.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/groups.php">Groups</a>
  <?php } ?>

  <?php if(in_array("permissions.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/permissions.php">Permissions</a>
  <?php } ?>

  <a href="/UNIVERSITY_LIBRARY/public/views/library.php">Library</a>
  <a href="/UNIVERSITY_LIBRARY/public/views/borrowed_books.php">Borrowed Books</a>
  
  <?php if(in_array("reg_reqs.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/reg_reqs.php">Admin registration requests</a>
  <?php } ?>

  <?php if(in_array("Email.php",$_SESSION['permissions'])){?>
  <a href="/UNIVERSITY_LIBRARY/public/views/Email.php">Emails</a>
  <?php } ?>
  <a href="/UNIVERSITY_LIBRARY/index.php">Home</a>

</div>

