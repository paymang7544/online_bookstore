<?php session_START(); ?>
<!--logout page,online book store,payman,NOV2015,WebIII.tutor Mark-->
<?php

//redirect user to login pag bif not logged in.
  /*if(!isset($_SESSION['id']))
  {require('authorlogin_tools.php'); load();}*/
//adding page title & header
$page_title = 'Goodbye';
include('includes/header.html');
//clear existing session variables.
$_SESSION = array();
session_destroy();
//confirmation logout message
echo '<h1>Goodbye</h1>
<p>You are now logged out.</p>
<p><a href="author_login.php">Login</a></p>;
<p><a href="main_homepage.html">Home</a></p>';
include('includes/footer.html');
?>