<?php 
 #function load to load a page specified as its argument.
function load($page = 'author_login.php')
{
#build a URL string of protocol ,current domain and directory.
$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['php_SELF']).'/online_bookstore';

#remove any trailing slashes from url,append a forward slash and specific page argument.
$url = rtrim($url, '/\\');
$url .= '/' .$page;

#load the specific page.
  header("Location: $url");
exit();
}
#validate function,validate user log in inputand supply error.
  function validate($dbc, $username ='', $pass ='')
  {
  $errors = array(); //initiate an array for error message
    if(empty($username))
    {$errors[]= null; echo  "Enter your username please.";}
    else
    {$u = mysqli_real_escape_string($dbc, trim($username));}
    if(empty($pass))
    {$errors[]= null; echo  "<br>.Enter your password please.";}
    else
    {$p = mysqli_real_escape_string($dbc, trim($pwd));}
   
    
      if(empty($errors))//store an error if username and password not found.
      { $q = "SELECT id,firstname, lastname,pwd
         FROM author WHERE username = '$u' AND pwd = SHA1('$p')";
        
        
        $r= mysqli_query($dbc, $q);  
       
        if(mysqli_num_rows($r)== 1)
        {
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
          
        return array(true, $row);        
        }
        else{$errors[]=NULL;  echo "<br>Username and/or password not found.";}
        
          }
      //return the list of error
      return array(false, $errors);
    }
   
?>