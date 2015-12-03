<!DOCTYPE html>
<html>
 <head>
    <!--title of page-->
  <meta charset="UTF-8">

 </head>
	<body>
	<?php
	$page_title = 'author login';
	include('includes/header.html');
	#if login failed provide an error and back to registeration page.
	if(isset($errors)&& !empty($errors))
	{
	echo '<p id="err-msg"> Sorry! there was  a problem:<br>';
		foreach($errors as $msg)
		{
		echo "- $msg<br>";
		}
		echo 'Please try again  or <a href="author_register.php">Register</a></p>';	
	}
	echo'
	<h1>Login</h1>
		<form action="author_login_action.php" method ="POST">
		<p>
		Username : <input type="text" name="username">
		</p><p>
		Password : <input type="password" name="pass">
		</p><p>
		<input type="submit" value="Login"><br><br><a href="main_homepage.html">Home</a>
		</p><br><br>
		</form>';
		
	include('includes/footer.html');	
	?>
	</body>
</html>
	
