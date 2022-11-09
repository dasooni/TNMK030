<?php
error_reporting(E_ALL);

ini_set("display_errors",1);

print($_POST['pwd']);

 if($_POST['pwd'] != '123') {
	 print("Error, Wrong password!");
} else {
	
	$connection	= mysqli_connect("mysql.itn.liu.se", "blog_edit", "bloggotyp", "blog");

	if(!$connection){
		die("Connection failed: " . mysqli_connect_error());
	} else{
		
	
		if($connection) {
			$author	=	mysqli_real_escape_string($connection,	$_POST["author"]);									
			$heading	=	mysqli_real_escape_string($connection,	$_POST["heading"]);							
			$text	=	mysqli_real_escape_string($connection,	$_POST["text"]);
			$query	=	"INSERT	INTO	blog.dasse788	VALUES(NULL,	'$author',	'$heading',	'$text')";		
			//	Nu	har	vi	en	fråga i	$query som	vi	kan	skicka	till databasen														
			mysqli_query($connection,	$query);
			mysqli_close($connection);

			header("Location: ./Showposts.php"); /* Redirect */

			exit;
		}
	}
}

?>