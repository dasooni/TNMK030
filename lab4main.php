<?php 
error_reporting(E_ALL);
ini_set("display_errors",1);

include "Menu.txt"; 
?>

<div id="nform">
  <form method="POST" action="Submit.php">

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="author" placeholder="Username" size="50"><br>
	
	<label for="heading">Header:</label><br>
    <input type="text" id="heading" name="heading" placeholder="Title" size="50"><br>

    <label for="pwd">Password:</label><br>
    <input type="password" id="pwd" name="pwd" placeholder="Password" size="50"><br>

    <label for="text">Blog post:</label><br>
    <textarea name="text" placeholder="Text..." rows="20" cols="100"></textarea><br>

    <input type="submit" value="Submit">
  </form>
</div>


</body>

</html>