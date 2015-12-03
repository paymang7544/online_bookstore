<?php # Access session.
session_start();?>
<!--update price page for author, NOV 2015,Payman,online bookstore.-->
<?php error_reporting(E_ALL ^ E_NOTICE);//return all errors except notice ?>

<?php # DISPLAY link to update the price of a book by author PAGE.

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'id' ] ) ) { require ( 'authorlogin_tools.php' ) ; load() ; }
$user_id=$_SESSION['id'];
 
# Set page title and display header section.
$page_title = 'book price update' ;
include ( 'includes/header.html' ); 

//Assigned passed item ID to a variable
  if(isset($_GET['id']))
  {
  $id = $_GET['id'];
  }
  $price=$_POST['currency'];
  
  #connect to db.
 require ('../connect_db.php');
  
  $q = " UPDATE shop SET item_price=$price WHERE item_id = $id AND author_id=$user_id";
  $r = mysqli_query($dbc, $q);
  $nr = mysqli_affected_rows($dbc);
  
    if($nr == 1)
    {
    
    echo "The price is  updated successfully, apologise for the error.";
    }else
    {echo "You are not allowed to update this book's price.'<br>'.
      If you think this is a server error please enter the price ";}
      
  mysqli_close($dbc);
  
  #form to update price
  echo '<form action="" method ="POST"><p>£
     <input  type="number" name="currency" min="1" max="999" 
     size="4" title="no comma(s) and no pens(.##) are all allowed" value="00.00"/><br><br>
    <input type="submit" value="Update the price"/>
    </form>';
    
    #Hyperlinks
    echo '<p><a href="shop.php">Shop</a> | 
        <a href="authorforum.php">Forum</a> |
        <a href="main_homepage.php">Home</a> | 
        <a href="goodbye.php">Logout</a></p>';
  
  
?>