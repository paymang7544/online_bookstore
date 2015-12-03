<!-- register page for author,online book store,NOV2015,payman,tutor Mark-->
<!DOCTYPE html>
<html>
 <head>
    <!--title of page-->
  <title><?php echo $page_title;?></title>
  <meta charset="UTF-8">
 
 </head>
  <body>
  
  <!-- just send serious error not notice-->
  <?php error_reporting(E_ALL ^ E_NOTICE); ?>
  
<?php  
$page_title = 'Author register';
#include a page header.
include('includes/header.html');

# process if the user input is equal to captcha and return a message.
#condition to check if form has been submitted.
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
#connecting db.
require('../connect_db.php');
$errors = array();

#error mes. if fields remain empty or save the values.
  
  $captcha=$_POST['captcha'];
  $user_captcha=$_POST['user_captcha'];
  if($captcha != $user_captcha)
  {
  $errors[] = 'Please try captcha again.';
  }
  if(empty($_POST['first_name']))
  {
  $errors[] = 'Enter your first name please.';
  }else{
  $_SESSION['firstname']=$_POST['first_name'];
  $fn = mysqli_real_escape_string($dbc, trim($_SESSION['firstname']));}//escape variable for security.
  if(empty($_POST['last_name']))
  {
  $errors[] = 'Enter your last name please.';
  }else{
  $ln= mysqli_real_escape_string($dbc, trim($_POST['last_name']));}//escape variable for security.
  if(empty($_POST['username']))
  {
  $errors[] = 'Enter your username please.';
  
  }else{$un = mysqli_real_escape_string($dbc, trim($_POST['username']));}//escape variable for security.
  
  if(empty($_POST['pass1']))
  {
  $errors[] = 'Enter your password please.';  
  }else{$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));}//escape variable for security.
  
  
  if(!empty($_POST['email']))
  {
  $em = $_POST['email'];//validate format of entered email
  $pattern = '/\b[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}\b/';
    if(!preg_match($pattern , $em))
    {
    $em = NULL; echo 'Email address is incorrect format';
    }else{$em = mysqli_real_escape_string($dbc, trim($_POST['email']));}//escape variable for security. 
   
    
  }else{ $errors[] = 'Enter your email please.';}
  
  #store password value in a variable if the passwords are a valid match or the first field is empty.
    if(!empty($_POST['pass1']))
    {
      if($_POST['pass1'] != $_POST['pass2'])
      {
      $errors[] = 'password do not match please try again.';
      }
      else{$p= $_POST['pass1'];$p = mysqli_real_escape_string($dbc,trim($_post['pass1']));}
    }
    else{$error[] = 'Enter your password';}
    #store an error message if the email already registered in databases
      if(empty($error))
      {
      $q = "SELECT id FROM author WHERE email='$em'";
      $r = mysqli_query($dbc ,$q);
        if( mysqli_num_rows($r)!== 0)
        {
        $errors[] = 'Email address is already registered.<a href = "author_login.php">login</a>';
        }
        
         }
      #store user data in the database table and display confirmation.
        if(empty($errors))
        {
      
        $q = "INSERT INTO author(firstname, lastname, username,pwd, email, regdate)
        VALUES ('$fn', '$ln', '$un', SHA1('$p'), '$em', SYSDATE())";
        
        $r = mysqli_query($dbc, $q);
        if($r== false){echo mysqli_error($dbc);}
          if($r)
          {
          echo'<h1>Registered!<h1>
          <p>You are now registered.</p>
          <p><a href="author_login.php">Login</a></p>';
          }
          mysqli_close($dbc);
          include('includes/footer.html');
          exit();
          #Append alternative statements to display all stored error.
        }else
          {
          echo '<h1>Error!</h1>
          <p>The following errors occured:<br>';
            foreach($errors as $msg)
            {
            echo "- $msg<br>";
            }
            echo 'Please try again.</p>';
            mysqli_close($dbc);      
          
          }
      
}
#function random,create a string of 6 random number and return the result.
function Random()
{$length = 6;
$str = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
$max = strlen($str)-1;
$random_str = "";
  for($i = 0; $i<$length; $i++)
  {
  $number = mt_rand(0 , $max);
  $random_str.=substr($str,$number, 1);
  }
  return $random_str;
}
  $random = Random();
  
?><!--start a sticky form-->
  <h1>Register</h1>
  <form action="author_register.php" method="POST">
  <p>
  First Name:<input type="text" name="first_name" value="<?php if(isset($_POST['first_name']))
      echo $_POST['first_name'];?>">
  Last Name:<input type="text" name="last_name" value="<?php if(isset($_POST['last_name']))
      echo $_POST['last_name'];?>">
      </p><p>
  Username:<input type="text" name="username" value="<?php if(isset($_POST['username']))
      echo $_POST['username'];?>">
      </p><p>
  Email Address:<input type="text" name="email" value="<?php if(isset($_POST['email']))
      echo $_POST['email'];?>">
      </p><p>
  Password:<input type="text" name="pass1" value="<?php if(isset($_POST['pass1']))
      echo $_POST['pass1'];?>">
  Confirm Password:<input type="text" name="pass2" value="<?php if(isset($_POST['pass2']))
      echo $_POST['pass2'];?>">
      </p>
      <p class="captcha"> <?php echo $random;?></p>
  <p>Please enter the above codes in the empty field</p>
  <input type="text" name="user_captcha" />
  <input type="hidden" value="<?php echo $random;?>" name="captcha"/><br>
  <input type="submit" value="Register"></p>
  </form><br>  
  
  <?php include('includes/footer.html'); ?>
  </body>
</html>
      
  
  
  
