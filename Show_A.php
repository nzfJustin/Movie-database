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
 	<br> <br>
 	<h3> Actor Information Page: </h3>
 	<hr>
 	<div>
	 	<label for="search_input">Search:</label>
		  	<form action="search.php" method ="GET">
			    <input type="text" placeholder="Search by Actor name..." name="search_key">
			    <input type="submit" value="Search!" class="hollow button">
			</form>
	</div>
	<div>
	<?php

		$db = new mysqli('localhost', 'cs143','','CS143'); //connect to database
		if ($db->connect_errno > 0){
	  		die('Unable to connect to database [' . $db->connect_error . ']');
	 	}
	 	// echo "Connected to databse!<br>";

		if ($_GET['aid']){
			$id = $_GET['aid'];
			// echo "get aid successfully! $id<br>";
			$A_query = "SELECT * FROM Actor WHERE id = $id;";
			// echo "$A_query <br>";
			$actor_info = $db->query($A_query); // unique info
			// $actor_row = $actor_info->fetch_assoc();
			if ($actor_info->num_rows >= 1) {  ?>
	</div>
	<hr>
	<h5>Actor Information is:</h5>
	<div>		
	<?php
				echo "<table border='1'><tr align = left>";
			    echo "<td><b>Actor Name</b></td>";
			    echo "<td><b>Sex</b></td>";
			    echo "<td><b>Date of Birth</b></td>";
			    echo "<td><b>Date of Death</b></td>";
			    echo "</tr>\n";

			    while($actor_row = $actor_info->fetch_assoc()){
			      echo "<tr>";
			      echo '<td>' .$actor_row[first].' '. $actor_row[last].'</td>';
			      echo '<td>'. $actor_row[sex] .'</td>';
			      echo '<td>'. $actor_row[dob] .'</td>';
			      if ($actor_row[dod] == '')
			      	echo '<td> Still Alive </td>';
			      else
			      	echo '<td>'. $actor_row[dod] .'</td>';
			      echo "</tr>";

			    }
			    echo "</table>";
			}
		}
	?>
	</div>
	<div> 
	<?php
		if ($_GET['aid']){
			$AM_query = "SELECT title,role,id FROM Movie INNER JOIN (SELECT mid,role FROM MovieActor WHERE aid = $id) temp ON id = mid;";
			// echo "$AM_query <br>";
			$actorActMovieInfo = $db->query($AM_query);
			// $ActorinMovie_Row = $actorActMovieInfo->fetch_assoc();
			if ($actorActMovieInfo->num_rows >= 1) {  ?>
	</div>
	<h5>Actor's Movies and Role:</h5>		
	<div>
	<?php
				echo "<table border='1'><tr align = left>";
			    echo "<td><b>Movie Title</b></td>";
			    echo "<td><b>Role</b></td>";
			    echo "</tr>\n";

			    while($ActorinMovie_Row = $actorActMovieInfo->fetch_assoc()){
			      echo "<tr>";
			      echo '<td><a href = "./Show_M.php?mid='.$ActorinMovie_Row[id].'">'.$ActorinMovie_Row[title] .'</a></td>';
			      echo '<td>' .$ActorinMovie_Row[role].'</td>';
			      echo "</tr>";
			    }
			    echo "</table>";
			}
		}
		$db_close();	
	?>	
	</div>
	

</body> 
</html> 