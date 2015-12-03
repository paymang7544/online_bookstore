<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php # DISPLAY link to delete a book by author PAGE.

# Access session.
#type the name of user on the top of page
session_start();
$firstname=$_SESSION['firstname'];
echo 'Hello'." ".$firstname;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'id' ] ) ) { require ( 'authorlogin_tools.php' ) ; load() ; }
$user_id=$_SESSION['id'];

# Set page title and display header section.
$page_title = 'Author delete a book' ;
include ( 'includes/header.html' );
//Assigned passed item ID to a variable
  if(isset($_GET['id']))
  {
  $id = $_GET['id'];
  }
  #connect to db.
require ('../connect_db.php');
  
  $q = " DELETE FROM shop WHERE item_id = $id AND author_id=$user_id";
  $r = mysqli_query($dbc, $q);
  $nr = mysqli_affected_rows($dbc);
  
    if($nr == 1)
    {
    //$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    
    echo "item deleted successfully.";//$r = mysqli_query($dbc, $q);
    }else
    {echo "You are not allowed to delete this book";}
      
  mysqli_close($dbc);
?>





