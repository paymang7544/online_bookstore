
<!DCTYPE HTML>
<body>
<html>
<?php
# process if the user input is equal to captcha and return a message.
if(isset($_POST['submit']))
{
$captcha=$_POST['captcha'];
$user_captcha=$_POST['user_captcha'];

	if($captcha != $user_captcha)
	{
	die('<p class= "error">Please enter the codes correctly</p>');
	}
	else{ echo '<p class="true">The code is correct</p>';}
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
?>	
<!--Display form and pass data to same page.-->
	<form action="" method="POST">
	<p class="captcha"> <?php echo $random;?></p>
	<p>Please enter the above codes in the empty field</p>
	<input type="text" name="user_captcha" />
	<input type="hidden" value="<?php echo $random;?>" name="captcha"/><br>
	<input type="submit" name="submit" value="Send"/>
	</form>




</body>
</html>