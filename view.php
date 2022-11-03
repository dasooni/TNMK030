<?php
$limit = $_GET['limit'];
$search = $_GET['search'];
?>

<div id="nform">
	<form method="GET" action="view.php">
		<input type="submit" value="Show last posts" name="limit">
	</form>
</div>
	
<div id="nform">
	<form action="view.php" method="GET">
		<input text="search" name="search">
		<input type="submit" value="search"><br>
	</form>
</div>

<?php 

error_reporting(E_ALL);
ini_set("display_errors",1);


$connection = mysqli_connect("mysql.itn.liu.se", "blog", "", "blog");


$query = "SELECT * FROM dasse788";

if($limit){
	$query = "SELECT * FROM dasse788 ORDER BY entry_date DESC LIMIT 5";
}

if($search){
	$query = "SELECT * FROM dasse788 WHERE (entry_author LIKE '%$search%' OR entry_text LIKE '%$search%' OR entry_heading LIKE '%$search%') ORDER BY entry_date";
	
}

$result = mysqli_query($connection, $query);
//	Skriv	ut	alla	poster	i	svaret																					
while ($row = mysqli_fetch_array($result)) {
    $heading = $row['entry_heading'];
    print("<h2>$heading</h2>\n");
    $author = $row['entry_author'];
    $date = $row['entry_date'];
    print("<p>$author,	$date</p>\n");
    $text = $row['entry_text'];
    print("<p>$text</p>\n");
    print("<hr/>");
}    //	end	while	
?>



</body>

</html>