<?php session_start();?>
<!--confirming cart addition page,NOV 2015,tutor Mark,Paymang7544-->
<?php
#type the name of user on the top of page

$firstname=$_SESSION['firstname'];
echo 'Hello'." ".$firstname;

//redirect to log in page+page title & header
if(!isset($_SESSION['id']))
  {
  require ('authorlogin_tools.php');
  load();
  }
  $user_id = $_SESSION['id'];
  $page_title = 'Cart Addition';
  include('includes/header.html');
  
  //Assigned passed item ID to a variable
  if(isset($_GET['id']))
  {
  $id = $_GET['id'];
 require ('../connect_db.php');
  
  $q = "SELECT * FROM shop WHERE item_id = $id";
  $r = mysqli_query($dbc, $q);
  $nr = mysqli_num_rows($r);
    if($nr == 1)
    {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    
    //add selected item to cart and display a confirm message.
      if(isset($_SESSION['cart'][$id]))
      {
      $_SESSION['cart'][$id]['quantity']++;
      echo '<p>Another'." ".$row["item_name"]." ".'has been added to your cart</p>';
      }else
      {
      $_SESSION['cart'][$id]= array('quantity' =>1, 'price'=>$row['item_price']);
      echo '<p>A'." ".$row["item_name"]." ".'has been added to your cart</p>';
      }
      }
  }
    mysqli_close($dbc);
    
    //Hyperlinks
    echo'<p><a href="shop.php">Shop</a> |
    <a href="cart.php">view Cart</a> |
    <a href="authorforum.php">Forum</a> |
    <a href="main_homepage.php">Home</a> |
    <a href="goodbye.php">Logout</a></p>';
      include('includes/footer.html');
    

?>