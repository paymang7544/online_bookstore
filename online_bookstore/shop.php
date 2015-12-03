<?php session_start();?>
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
  width:5%;
  padding:1px;
  }
  </style>
 </head>
  <body>
  <form action="search.php" method="POST">
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
  require('authorlogin_tools.php');
  load();
  }
  
//page title and header
$page_title = 'Shop';
include('includes/header.html');
require ('../connect_db.php');
  
//reterieve all items from db.
  $q="SELECT * FROM shop";
  $r = mysqli_query($dbc , $q);
  $nr = mysqli_num_rows($r);
  if($nr>0)
    {
    
    echo '<table>';
    $counter=0;
      while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
      {
      if($counter==0)
      {echo '<tr>';}
        
echo '<td><strong>'.$row['item_name'].'</strong><br>
<br><a href ="desc.php?id='.$row['item_id'].'"><img src='.$row['item_img'].' width="80" height="80">
</a><br>£'.$row['item_price'].'<br><a href ="added.php?id='.$row['item_id'].'">Add To Cart</a>
<br><a href ="authordelete_book.php?id='.$row['item_id'].'">Delete</a>
<br><a href ="authorupdate_price.php?id='.$row['item_id'].'">Update price</a></td>';
        
      $counter++;
      if($counter ==4)
      {
      $counter=0;
      echo '</tr>';
      }
      
      }
      echo '</table>';
      mysqli_close($dbc);
      
    }else
    {
    echo '<p>There are currently no items in this shop</p>';
    }
      //hyperlinks and footer
      echo '<p><a href = "cart.php">View Cart</a> |
      <a href = "authorforum.php">Forum</a> |
      <a href = "main_homepage.html">Home</a>  |
      <a href = "goodbye.php">Logout</a>  |
      <a href="authorpost.php">Post Comment</a> |
      <a href="authoradd_book.php">Add a Book</a></p>';
      include('includes/footer.html');
?>
  </body>
</html>