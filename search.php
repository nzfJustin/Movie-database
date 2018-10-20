<html>
<head>
	<title>Search Actor/Movie</title>
	<link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
div {
    margin-left: 10px;
    margin-right: 60px;
}
</style>
<body>
	<br>
	<br>
	<h3>Search for actors/movies</h3>
		<form method="get" action="./search.php" >
			<div class="large-10 columns">
	          <label>Search: 
	            <input type="text" placeholder="Actor/Movie" name="search_key"/>
	          </label>
	          <input type="submit" class = "hollow button" value="Search!">
	          <hr>
	        </div>	
		</form>
	
	<?php
		$db = new mysqli('localhost', 'cs143','','CS143'); //connect to database
    	if ($db->connect_errno > 0){
      		die('Unable to connect to database [' . $db->connect_error . ']');
	 	}
	 	// echo "Connected to databse<br>";
	    if (isset($_GET['search_key']) && $_GET['search_key']){
	    	$search_key = $db->real_escape_string($_GET['search_key']);
			$search_key_array = explode(" ", $search_key);
			// echo "search_key array starts with $search_key_array[0] <br>";
			if (sizeof($search_key_array) > 0){	
				$size = sizeof($search_key_array);

				// search Actor DB
				$db->query('CREATE VIEW ActorView0 AS SELECT id,dob,concat_ws(" ",first,last) AS fullname FROM Actor');
				for($i = 1; $i <= $size; $i++){
					$db->query('CREATE VIEW ActorView'.$i.' AS SELECT * FROM ActorView'.($i - 1).' WHERE fullname LIKE "%'.$search_key_array[$i-1].'%"');
				}
				$actor_result = $db->query('SELECT id,fullname,dob FROM ActorView'.(sizeof($search_key_array)).';');
				for ($i = sizeof($search_key_array); $i >= 0; $i--){
					$db->query('DROP VIEW ActorView'.$i);
				}

				// search the Movie DB
				$db->query('CREATE VIEW MovieView0 AS SELECT * FROM Movie WHERE title LIKE "%'.$search_key_array[0].'%";');
				for ($i = 1; $i < $size; $i++){
					$db->query('CREATE VIEW MovieView'.$i.' AS SELECT * FROM MovieView'.($i - 1).' WHERE title LIKE "%'.$search_key_array[$i].'%"');
				}
				$movie_result = $db->query('SELECT id,title,year,rating,company FROM MovieView'.($size-1));
				for ($i = $size - 1; $i >= 0; $i--){
					$db->query('DROP VIEW MovieView'.$i);
				}
			}
		
	 
	?>
	<div>
	Searching for <?php echo $_GET['search_key']?>... <br>
	<?php
			if ($actor_result->num_rows < 1 && $movie_result->num_rows < 1)
				echo "No result found. <br>";
		}

		if ($actor_result->num_rows >= 1) {
	?>
		<h6>Loading records in Actor database...<h6>

	<?php
			// $fields_num = $actor_result->field_count;
			echo "<table border='1'><tr align = left>";
		    echo "<td><b>Actor Name</b></td>";
		    echo "<td><b>Date of Birth</b></td>";
		    echo "</tr>\n";

		    while($row = $actor_result->fetch_assoc()){
		      echo "<tr>";
		      echo '<td><a href = "./Show_A.php?aid='.$row[id].'">'.$row[fullname] .'</td>';
		      echo '<td>'. $row[dob] .'</td>';
		      echo "</tr>";
		    }
		    echo "</table>";
		}
	?>
	
	<?php
		if ($movie_result->num_rows >= 1) { 
	?>
		<h6>Loading records in Movie database...<h6>

	<?php
			echo "<table border='1'><tr align = left>";
			echo "<td><b>Movie Titile</b></td>";
		    echo "<td><b>Year</b></td>";
		    echo "<td><b>Rating</b></td>";
		    echo "<td><b>Company</b></td>";
		    echo "</tr>";
		
		    while($row = $movie_result->fetch_assoc()){
		      echo "<tr>";
		      echo '<td><a href = "./Show_M.php?mid='.$row[id].'">'.$row[title] .'</td>';
		      echo '<td>'. $row[year] .'</td>';
		      echo '<td>'. $row[rating] .'</td>';
		      echo '<td>'. $row[company] .'</td>';
		      echo "</tr>";
		    }
		    echo "</table>";
		    $db_close();	
		}
	?>
	</div>
</body>
</html>