<!-- search box handeler page,NOV2015,payman,Colchester.Institute,tutor Mark-->
<!DOCTYPE html>
<html>
 <head>
  <title><?php echo $page_title;?></title>
  <meta charset="UTF-8">
  <style>
   table,th, td{
  border:1px solid black;
  width:15%;
  }
 td{
  border:1px solid black;
 width:5%;
  }
  </style>
 </head>
  <body>
<?php
#take the desired book name by post
$bookname=$_POST['search'];

#connection to dba
require ('../connect_db.php');
//reterieve all items from db.
  $q="SELECT * FROM shop WHERE item_name='$bookname'";
  $r = mysqli_query($dbc , $q);

  $nr = mysqli_affected_rows($dbc);
  
    if($nr == 1)
    {
    
    echo '<table><tr>';
      while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
      {
      echo '<td><strong>'.$row['item_name'].'</strong><br>
      <br><a href ="desc.php?id='.$row['item_id'].'"><img src='.$row['item_img'].' width="80" height="80"></a><br>'.
        $row['item_price'].'<br><a href ="customer_added.php?id='.$row['item_id'].'">Add To Cart</a>
        </td>';
    
      }
      echo '</tr></table>';
      mysqli_close($dbc);
    }else
    {
    echo '<p>There are currently no items in this shop</p>';
    }
    
    //hyperlinks and footer
      echo '<p><a href = "customer_cart.php">View Cart</a> |
      <a href = "customerforum.php">Forum</a> |
        <a href = "customer_shop.php">shop</a> |
      <a href = "main_homepage.html">Home</a>  |
      <a href = "customer_goodbye.php">Logout</a>';
      include('includes/footer.html');
  ?>
  </body>
</html>