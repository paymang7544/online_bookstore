<?php session_start();?>
<!--checkout for customer,Payman,webIII,tutor Mark,Nov2015,Colch. Inst.-->
<?php # DISPLAY CHECKOUT PAGE.

# Access session.
#type the name of user on the top of page

$firstname=$_SESSION['firstname'];
echo '<p style="color:red";>Hello'." ".$firstname." ".'Please do not leave this page without downloading your purchased book first.<p>';

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'id' ] ) ) { require ( 'customer_login_tools.php' ) ; load() ; }
$user_id=$_SESSION['id'];
# Set page title and display header section.
$page_title = 'Checkout' ;
include ( 'includes/header.html' ) ;

# Check for passed total and cart.
if ( isset( $_GET['total'] ) && ( $_GET['total'] > 0 ) && (!empty($_SESSION['cart']) ) )
{
  # Open database connection.
  require ('../connect_db.php');
  
  # Store buyer and order total in 'orders' database table.
  $q = "INSERT INTO orders ( user_id, total, order_date ) VALUES (". $_SESSION['id'].",".$_GET['total'].", NOW() ) ";
  $r = mysqli_query ($dbc, $q);
  
  # Retrieve current order number.
  $order_id = mysqli_insert_id($dbc) ;
  
  # Retrieve cart items from 'shop' database table.
  $q = "SELECT * FROM shop WHERE item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
  $r = mysqli_query ($dbc, $q);

  # Store order contents in 'order_contents' database table.
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    $query = "INSERT INTO order_contents ( order_id, item_id, quantity, price )
    VALUES ( $order_id, ".$row['item_id'].",".$_SESSION['cart'][$row['item_id']]['quantity'].",".$_SESSION['cart'][$row['item_id']]['price'].")" ;
    $result = mysqli_query($dbc,$query);
  
  $row_item = $row['item_id'];

  $quer = "SELECT * FROM shop WHERE item_id=$row_item";
  $res = mysqli_query ($dbc, $quer);

  $row = mysqli_fetch_array ($res, MYSQLI_ASSOC);
  $name = $row['item_name'];
    if(!empty($row['item_path']))
    {
    $path=$row['item_path'];
    echo $path.'<br>';
    echo "<a href= '$path' download='$name'>Download</a><br><br><br>";
    
    
    /*$q="SELECT email FROM customer WHERE id=$user_id ";
    $resu = mysqli_query($dbc,$q);
    $row=mysqli_fetch_array($resu,MYSQLI_ASSOC);
    $email=$row['email'];
    echo $email;
    echo '<form action = "mailto:$email"method="GET">
    <input type="submit" value="Send to your email address">
    </form>';*/
    }
    else
      {echo "Sorry this book ($name) is not available at the moment we will refund your money in 24 hours'<br>' ";}
  
  }
   # Display order number.
  echo "<p>Thanks for your order. Your Order Number Is #".$order_id."</p>";
  
  # Close database connection.
  mysqli_close($dbc);

 

  # Remove cart items.  
  $_SESSION['cart'] = NULL ;
}
# Or display a message.
else { echo '<p>There are no items in your cart.</p>' ; }

# Create navigation links.
echo '<p><a href="customer_shop.php">Shop</a> | <a href="customerforum.php">Forum</a> |
 <a href="main_homepage.html">Home</a> | <a href="customer_goodbye.php">Logout</a></p>' ;

# Display footer section.
include ( 'includes/footer.html' ) ;

?>