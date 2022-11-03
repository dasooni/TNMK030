<!DOCTYPE html>

<head>
    <title>Laboration 3</title>
    <meta name='Author' content='Dasmit Sethi'>
    <meta name='Description' content='Labb 3/4'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="stylesheet.css">
    <script src = "lab2.js"></script>

</head>

<body>
    <h1>Blogsida</h1>
    <div class = "navbar">
        <nav>
            <ul>
                <a href="index.html">Hem</a>
                <a href="minions.html">Film: Minions (2015)</a>
                <a href=form.html>Blogg</a>
                <a href="lab3.php" class="active">Lab 3</a>
                <button onclick = "darkMode()"> Dark Mode </button>
                <button onclick = "lightMode()"> Light Mode </button>
            </ul>
        </nav>
    </div>
		<form action="Labb3_debug.php" method="get"> 
			<label for="numPosts">Number Of Posts:</label>
			<input type="number" id="numberOfPosts" name="numPosts" placeholder="Number of posts" autofocus>

			<label for="searchInput">Search:</label>
			<input type="text" id="searchID" name="searchInput" placeholder="Enter some text">			
			<input type="submit"><br>
		</form>
		</div>
    </div>
	
    <?php
	// Koppla upp mot databasen
	//$connection = mysqli_connect("mysql.itn.liu.se","blog_edit","bloggotyp","blog");
    $connection = mysqli_connect("mysql.itn.liu.se","blog", "", "blog");
	if(!$connection){
		die('MySQL connection error');
	}
	$numPosts = 4;
	$searchAuthor = "";
	$sql = "SELECT * FROM dasse788 ORDER BY entry_date DESC LIMIT ". $numPosts;
	
	if($_SERVER['REQUEST_METHOD'] === 'GET'){
		if(mysqli_real_escape_string($connection, $_GET['numPosts']) != $numPosts && mysqli_real_escape_string($connection, $_GET['numPosts']) > 0){
			$numPosts = mysqli_real_escape_string($connection, $_GET['numPosts']);
			$sql = "SELECT * FROM dasse788 ORDER BY entry_date DESC LIMIT ". $numPosts;
		}
		
		if(mysqli_real_escape_string($connection, $_GET['searchInput']) != $searchAuthor && mysqli_real_escape_string($connection, $_GET['searchInput']) != ""){
			$searchAuthor = mysqli_real_escape_string($connection, $_GET['searchInput']);
			$sql = "SELECT * FROM dasse788 WHERE entry_heading LIKE '%".$searchAuthor."%' or entry_author LIKE '%".$searchAuthor."%' 
			or entry_date LIKE '%".$searchAuthor."%' or entry_text LIKE '%".$searchAuthor."%' ORDER BY entry_date DESC LIMIT ". $numPosts;
		}

	}

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$author    =    mysqli_real_escape_string($connection, $_POST['author']);            //	Namnet	på	formulärfälten	bestäms												
		$heading    =    mysqli_real_escape_string($connection, $_POST['heading']);    //	med	attribut	i	HTML-koden för	formuläret				
		$text    =    mysqli_real_escape_string($connection, $_POST['entry']);
		$query	=	"INSERT INTO dasse788 VALUES(NULL,'$author','$heading','$text')";
		
		if($_POST['password'] !='123'){
			print('<p>FEL LÖSENORD</p>');

		// Nu har vi en fråga i $query som vi kan skicka till MySQL
		} else {
			mysqli_query($connection, $query);
		}
	} 
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
	}
	mysqli_close($connection);
    ?>
	
</body>