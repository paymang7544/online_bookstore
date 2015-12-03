<!--upload handle page,online bookstore,NOV2015,payman,Colchester Institute,tutor Mark.-->
<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'id' ] ) ) { require ( 'authorogin_tools.php' ) ; load() ; }
$id = $_SESSION[ 'id' ];
# Set page title and display header section.
$page_title = 'Author upload a book' ;
include ( 'includes/header.html' );

#extract post variables.
extract($_POST);
$file_name = $_FILES['UploadedFile']['name'];
$target_path = "uploads/".$file_name;
$file_covername = $_FILES['UploadedcoverFile']['name'];
$target_coverpath = "uploads/".$file_covername;
$price=$_POST['item_price'];
$desc=$_POST['item_desc'];

$name=$_POST['item_name'];
if(move_uploaded_file($_FILES['UploadedFile']['tmp_name'], $target_path))
  {

//connect to db and insert data and check for error
require('../connect_db.php');
  $q= "INSERT INTO shop(item_id,author_id,item_name, item_desc,item_img,item_price,item_path, upload_date)
 VALUES( '','$id','$name','$desc','$target_coverpath','$price','$target_path',NOW())";
          
          $r = mysqli_query($dbc,$q);
         
          $nr = mysqli_affected_rows($dbc);
  
    if($nr=1) 
    {
      
      echo "files are uploaded successfully";
      }
    else
      {echo "Sorry!there was a problem";}  
  }

//hyperlinks and footer
      echo '<p><a href = "cart.php">View Cart</a> |
      <a href = "authorforum.php">Forum</a> |
      <a href = "homepage.php">Home</a>  |
      <a href = "goodbye.php">Logout</a>  |
      <a href = "shop.php">Shop</a>  |
      <a href="authoradd_book.php">Add a Book</a></p><br>';
      include('includes/footer.html');

?>
