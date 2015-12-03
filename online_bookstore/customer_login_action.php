<?php
#start session
 session_start();

#check if the login form has been submitted.
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
require ('../connect_db.php');
require('customerlogin_tools.php');

#ensured login succeeded and get the associated user details
list($check , $data) = validate($dbc, $_POST['username'], $_POST['pass']);
//set the user info as session global variables.
  if($check)
  {  
  $_SESSION['id'] = $data['id'];
  $_SESSION['firstname'] = $data['firstname'];
  $_SESSION['lastname'] = $data['lastname'];
  $page_title='Home';
  include('includes/header.html');  
 
echo "<p>You are now logged in:<br>{$_SESSION['firstname']} <br>{$_SESSION['lastname']}</p>";
#add hyperlink to other pages.

echo '<p>

<a href = "customer_shop.php">shop</a> |
<a href = "customer_goodbye.php">Logout</a>
</p>';
  }
  else{ $errors = $data; 
  echo '<a href="customer_register.php">Register please</a>';
  echo'<br><p><a href="customer_login.php">Try again</a>';}
  mysqli_close($dbc);
}
  

?>