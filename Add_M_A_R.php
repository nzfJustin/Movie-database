<!DOCTYPE html>
<html>

<head>
	<title>Add Actor/Director</title>
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

<br><br>
<h3> Add new actor in a movie:</h3>

<form method = "GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<div class="large-10 columns">
			Please fill in the following information:<br><br>
			<!-- without rolldown list -->
			<!-- Movie Name: <input type = "text" name ="movie"><br><br> -->
			<label>Movie: </label>
			<select id="movie" name ="movie" style="width:600px">
				<option>
				<?php
					
					$db = new mysqli('localhost', 'cs143','','CS143'); //connect to database
				 	if($db->connect_errno > 0){
				    	die('Unable to connect to database [' . $db->connect_error . ']');   
					}

					$db->select_db("CS143");
					$db->query('CREATE VIEW order_movie AS SELECT * FROM Movie ORDER BY title');
					$all_movie="SELECT id,title,year FROM order_movie;";
					$query_select_movie=$db->query($all_movie);
					$db->query('DROP VIEW order_movie');
			
					while ($resultmovie = $query_select_movie->fetch_assoc()) {	
						echo '<option value="'.$resultmovie['id'].'">'.$resultmovie['title'].'('.$resultmovie['year'].')'.'</option>';
					}
				?>
			</select>
			<label>Actor: </label>
			<select id="actor" name ="actor" style="width:300px">
				<option>
				<?php
					$db->query('CREATE VIEW order_actor AS SELECT * FROM Actor ORDER BY first, last');
					$all_actor="SELECT id,first,last,dob FROM order_actor;";
					$select_Actor=$db->query($all_actor);
					$db->query('DROP VIEW order_actor');
			
					while ($resultactor = $select_Actor->fetch_assoc()) {	
						$actor_full_name = $resultactor['first'].' '.$resultactor['last'];
						echo '<option value="'.$resultactor['id'].'">'.$actor_full_name.'('.$resultactor['dob'].')'.'</option>';
					}
				?>
			</SELECT>

			<label>Role: </label>
			<input type="text" name="role" style="width:300px">
			<button type="submit" class="hollow button">Add!</button><br/><br/>
	  
			
		</div>

	
	</form>

<?php
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $movie_id = $_GET['movie'];
		$actor_id = $_GET['actor'];
		$actor_role = $db->real_escape_string($_GET['role']);
    }
    // echo "$movie_name, $movie_rating, $movie_comment" ;

	$insert = "INSERT INTO MovieActor VALUES('$movie_id', '$actor_id', '$actor_role');";
	// echo "$insert <br>";
	if($db->query($insert))
		echo "New relation is added!<br>";
	$db_close();
	
?>
</body>
</html>