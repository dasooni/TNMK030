<!DOCTYPE html>

<head>
    <meta name='Author' content='Max Wiklundh & Philip Robertsson'>
    <meta name='Description' content='Laboration 3'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laboration 3</title>
    <link rel="stylesheet" media="screen" href="styles.css" type="text/css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <script src="scripts.js"></script>
</head>

<body onload="homeLoad()">
	<div class="headerDiv">
        <h1>Välkommen till Philip och Maxs hemsida</h1>
        <strong id="liveClock">Timme/minut/sekund/dag</strong>   
        <div class="menu">
            <ul>
                <li><a href="Labration2.html">Landningssida</a></li>
                <li><a href="Laboration2Sida2.html">Vår Favorit Bok</a></li>
				<li><a href="labb3sida.html">Skriv inlägg</a></li>
				<li><a href="Laboration3.php">Blogg</a></li>
                <li class="settings" onclick="changeStyle()">Ändra utseende</li>
                <li class="settings" onclick="changeP()">Ändra paragrafer</li>
            </ul>
		</div>
		<div>
			<form action="Labb3_debug.php" method="get"> <!--PHP_SELF-->
				<label for="numPosts">Number Of Posts:</label>
				<input type="number" id="numberOfPosts" name="numPosts" placeholder="Number of posts" autofocus>

				<label for="searchInput">Search:</label>
				<input type="text" id="searchID" name="searchInput" placeholder="Enter some text">			
				<input type="submit"><br>
			</form>
		</div>
    </div>
    <?php //include("blog.txt");    ?>
	
    <?php
	// Koppla upp mot databasen
	$connection = mysqli_connect("mysql.itn.liu.se","blog_edit","bloggotyp","blog");
	if(!$connection){
		die('MySQL connection error');
	}
	$numPosts = 4;
	$searchAuthor = "";
	$sql = "SELECT * FROM phiro138 ORDER BY entry_date DESC LIMIT ". $numPosts;
	
	if($_SERVER['REQUEST_METHOD'] === 'GET'){
		if(mysqli_real_escape_string($connection, $_GET['numPosts']) != $numPosts && mysqli_real_escape_string($connection, $_GET['numPosts']) > 0){
			$numPosts = mysqli_real_escape_string($connection, $_GET['numPosts']);
			$sql = "SELECT * FROM phiro138 ORDER BY entry_date DESC LIMIT ". $numPosts;
		}
		
		if(mysqli_real_escape_string($connection, $_GET['searchInput']) != $searchAuthor && mysqli_real_escape_string($connection, $_GET['searchInput']) != ""){
			$searchAuthor = mysqli_real_escape_string($connection, $_GET['searchInput']);
			//$sql = "SELECT * FROM phiro138 WHERE entry_author ='".$searchAuthor."' ORDER BY entry_date DESC LIMIT ". $numPosts;
			$sql = "SELECT * FROM phiro138 WHERE entry_heading LIKE '%".$searchAuthor."%' or entry_author LIKE '%".$searchAuthor."%' 
			or entry_date LIKE '%".$searchAuthor."%' or entry_text LIKE '%".$searchAuthor."%' ORDER BY entry_date DESC LIMIT ". $numPosts;
		}
		
		/*
		$numPosts = mysqli_real_escape_string($connection, $_GET['numPosts']);
		$searchAuthor = mysqli_real_escape_string($connection, $_GET['searchInput']);
		*/
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$author    =    mysqli_real_escape_string($connection, $_POST['author']);            //	Namnet	på	formulärfälten	bestäms												
		$heading    =    mysqli_real_escape_string($connection, $_POST['heading']);    //	med	attribut	i	HTML-koden för	formuläret				
		$text    =    mysqli_real_escape_string($connection, $_POST['entry']);
		$query	=	"INSERT INTO phiro138 VALUES(NULL,'$author','$heading','$text')";
		
		if($_POST['password'] !='bojje'){
			print('<p>FEL LÖSENORD</p>');
		// Nu har vi en fråga i $query som vi kan skicka till MySQL!
		} else {
			mysqli_query($connection, $query);
		}
	} 
	// Ställ frågan
	//$sql = "SELECT * FROM phiro138 WHERE entry_author ='".$searchAuthor."' ORDER BY entry_date DESC LIMIT ". $numPosts;
	//echo($sql);
	$result = mysqli_query($connection, $sql);
	// Skriv ut alla poster i svaret
	while ($row = mysqli_fetch_array($result)){
		$heading = $row['entry_heading'];
		print("<h3>$heading</h3>");
		$author =$row['entry_author'];
		$date = $row['entry_date'];
		print("<p>$author</p>");
		print("<small>$date</small>");
		$text = $row['entry_text'];
		print("<p>$text</p>");
		print("<hr/>");
	}// end while
	mysqli_close($connection);
    ?>
	
</body>