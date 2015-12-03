<?php ob_start();
session_start();
#redirect if not logged in
require('authorlogin_tools.php');
if(!isset($_SESSION['id']))
  {
  load();
  } 
  
#page title
$page_title = 'Post Error';
include ('includes/header.html');

//check form fileds are not empty
  if($_SERVER['REQUEST_METHOD'] =='POST')
  {
    if(empty($_POST['subject']))
    {
    echo '<P>Please enter a subject for this post.</P>';
    }else{$_SESSION['subject'] = $_POST['subject'];}
    if(empty($_POST['message']))
    {
    echo '<P>Please enter a message for this post.</P>';      
    }else{$_SESSION['message'] = $_POST['message'];}
      if(!empty($_POST['subject']) && !empty($_POST['message']))
      {
      require('../connect_db.php');//connect to db and insert data and check for error
      
      $q= "INSERT INTO forum (id,firstname, lastname,subject,message,postdate)
          VALUES( '','{$_SESSION['firstname']}','{$_SESSION['lastname']}','{$_SESSION['subject']}','{$_SESSION['message']}',NOW())";
      
      $r = mysqli_query($dbc,$q);
      $affect = mysqli_affected_rows($dbc);
        if($affect!= 1)
        {
        echo '<p>Error</p>'.mysqli_error($dbc);
        
        }
        else{load('authorforum.php');}      
      mysqli_close($dbc);
      
      }
      
  }
          echo '<p><a href="authorforum.php">Forum</a>';
      include ('includes/footer.html');
      ob_config.php;
?>