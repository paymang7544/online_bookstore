<?php ob_start(); session_start();
if ( !isset( $_SESSION[ 'id' ] ) ) { require ( 'authorlogin_tools.php' ) ; load() ; }

#type nameof user on top of page
$firstname=$_SESSION['firstname'];
echo 'Hello'." ".$firstname;
 
# Set page title and display header section.
$page_title = 'book brief' ;
include ( 'includes/header.html' ); 

//Assigned passed item ID to a variable
  if(isset($_GET['id']))
  {
  $id = $_GET['id'];
  #connect to db.
 require ('../connect_db.php');
  
  $q = " SELECT * FROM shop WHERE item_id='$id'  ";
  $r = mysqli_query($dbc, $q);
  $nr = mysqli_affected_rows($dbc);
  
    if($nr = 1)
    {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $desc= $row['item_desc'] ;
    echo $desc;
  }   }
  
  # Create navigation links.
  echo '<p><a href="shop.php">Shop</a> | <a href="authorforum.php">Forum</a> |
  <a href="main_homepage.php">Home</a> | <a href="goodbye.php">Logout</a> |</p>' ;
  ob_end_flush;?>