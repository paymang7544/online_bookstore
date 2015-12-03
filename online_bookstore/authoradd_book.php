<?php # DISPLAY link to add a book by author PAGE.

# Access session.
#type the name of user on the top of page
session_start();
$firstname=$_SESSION['firstname'];
echo 'Hello'." ".$firstname;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'id' ] ) ) { require ( 'authorlogin_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Author add a book' ;
include ( 'includes/header.html' );/*<label>browse cover image</label>
		<input type="file" name="Uploaded_coverFile" />*/
echo '
<form enctype="multipart/form-data" action="uploader.php" method="POST">
		<input name="MAX_FILE_SIZE" value="100000" type="hidden" />
		<label>browse book file</label>
		<input type="file" name="UploadedFile" required/><br><br><br>
		<br>
		<label>browse bookcover image</label>
		<input type="file" name="UploadedcoverFile" required/><br><br>
		<p>Title of book:
		<input type="text" name="item_name" required/></p>
		<p>Brief of book:
		<input type="text" name="item_desc" required/></p>		
		<lable>Price:</label><input type="number" name="item_price" required/>
		<input type="submit" value="upload" />
	</form>';
	
	#Hyper links.
echo '<p><a href="shop.php">Shop</a>|<a href="authorforum.php">Forum</a> |
 <a href="main_homepage.html">Home</a> | <a href="goodbye.php">Logout</a></p>' ;


# Display footer section.
		
include ( 'includes/footer.html' ) ;


?>