<?php session_start();?>
<!--customer shop page,online bookstore,Nov 2015,payman,Colchester Inst.,tutor Mark,-->
<!DOCTYPE html>
<html>
 <head>
  
  <meta charset="UTF-8">
  <style>
   table,th, td{
  border:3px solid black;
  width:90%;
  }
 td{
  border:1px solid black;
  width:10%;
  padding:15px;
  }

  </style>
 </head>
  <body>
  <form action="customer_search.php" method="POST">
  <p>Search by Title:<input type="text" name="search">
  <input type="submit" value="search"></p>
  </form>
<?php
#type the name of user on the top of page
$firstname=$_SESSION['firstname'];
echo '<p style= "color:blue";>Hello'." ".$firstname ." " .'if you want to have a brief explanation of the books please click on their cover\'s image.</p>';

#redirect to login page if not logged in.
if(!isset($_SESSION['id'])&& $_POST['guest'])
  {
  require('customerlogin_tools.php');
  load();
  }
//page title and header
$page_title = 'customer Shop';
include('includes/header.html');

require ('../connect_db.php');
//reterieve all items from db.
  $q="SELECT * FROM shop";
  $r = mysqli_query($dbc , $q);
  $nr = mysqli_num_rows($r);
  if($nr>0)
    {    
    echo '<table>';
      $counter = 0;
      while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
      {
      if($counter == 0)
      {echo "<tr>";}
      
echo '<td><strong>'.$row['item_name'].'</strong><br>
<br><a href ="customer_desc.php?id='.$row['item_id'].'"><img src='.$row['item_img'].' width="80" height="80">
</a><br>£'.$row['item_price'].'<br><a href ="customer_added.php?id='.$row['item_id'].'">Add To Cart</a>
</td>';
      $counter++;
      if($counter == 4){
        $counter = 0;
        echo "</tr>";
      }
            
    }
    echo '</table>';
    mysqli_close($dbc);
    }else
    {
    echo '<p>There are currently no items in this shop</p>';
    }
      //hyperlinks and footer
      echo '<p><a href = "customer_cart.php">View Cart</a> |
      <a href = "customerforum.php">Forum</a> |
      <a href="customerpost.php">Post Comment</a> |        
      <a href = "main_homepage.html">Home</a>  |
      <a href = "customer_goodbye.php">Logout</a>';
      #add footer
      include('includes/footer.html');
?>
  </body>
</html>