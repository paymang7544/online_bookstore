<?php ob_start(); session_start(); ?>
<!--  forum page to retrieve message from database 10th NOV 2015,assignment1 webIII,tutor Mark-->
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <style>
   table,th, td{
  border:1px solid black;
  }
  </style>
 </head>
  <body> 
    <?php
#type the name of user on the top of page

$firstname=$_SESSION['firstname'];
echo 'Hello'." ".$firstname; 

#redirect to login page if is not logged in.
if(!isset($_SESSION['id']))
  {
  require('customerlogin_tools.php');
  load();
  }
#header and page title.
$page_title = 'Forum';
include('includes/header.html');

#connect to db
require ('../connect_db.php');

#retrieve message from db.
$q = "SELECT * FROM forum";
$r = mysqli_query($dbc, $q);
$rowcount = mysqli_num_rows($r);
if ($rowcount>0)
  {
  echo '<table><tr>
  <th><b>Posted By</b></th>
  <th><b>Subject</b></th>
  <th><b> Message</b></th>
  </tr>';
  while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
    {
    echo'<tr>
    <td>'.$row['firstname'].' '.$row['lastname'].''.$row['postdate'].'</td>
    <td>'.$row['subject'].'</td>
    <td>'.$row['message'].'</td>
    </tr>';  
    }
  echo'</table>';
  }
  else{ echo "<p>There are currently no message.</p>";}
  
  //Hyper link to other pages.
  echo '<p>
  <a href = "customerpost.php">Post Message</a>|
  <a href = "customer_shop.php">Shop</a>|
  <a href = "main_homepage.html">Home</a>|
  <a href = "customer_goodbye.php">Log out</a></p>';
  
  //close db & add footer
  mysqli_close($dbc);
  include('includes/footer.html'); ob_end_flush;?>
    </body>
    </html>