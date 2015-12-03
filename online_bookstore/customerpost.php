<?php session_start();// post a message page,onlinebookstore,NOV2015,tutor Mark,Payman,colchester institute.
#type the name of user on the top of page
$firstname=$_SESSION['firstname'];

//redirect to login page if not logged in.
if(!isset($_SESSION['id']))
  {
  require('customerlogin_tools.php');
  load();
  }
  
  //page title and header & form.
  $page_title = 'Post Message';
  include('includes/header.html');
  echo 'Hello'." ".$firstname;
  echo '<form action ="customerpost_action.php" method="POST" accept-charset="utf-8" >
      <p>Subject:
      <input  name="subject" type="text" size="64"></p>
      <p>Message:<br>
      <p><textarea name="message" rows="5" cols="50"></textarea></p>
      <p><input type="submit" value="submit"></p>
       </form>';
       
       //Hyperlinks to other pages
       echo'<p> 
      <a href = "customer_shop.php">Shop</a>|
      <a href = "main_homepage.html">Home</a>|
      <a href = "customer_goodbye.php">Log out</a></p>';
       //footer
       include ('includes/footer.html');?>
