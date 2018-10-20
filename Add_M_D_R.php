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
<h3> Add new Director in a movie:</h3>

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

					//$db->select_db("CS143");
					$db->query('CREATE VIEW order_movie AS SELECT * FROM Movie ORDER BY title');
					$all_movie="SELECT id,title,year FROM order_movie;";
					$all_movie="SELECT id,title,year FROM order_movie;";
					$query_selectmovie=$db->query($all_movie);
			
					while ($resultmovie = $query_selectmovie->fetch_assoc()) {	
						echo '<option value="'.$resultmovie['id'].'">'.$resultmovie['title'].'('.$resultmovie['year'].')'.'</option>';
					}
				?>
			</select>
			<label>Director: </label>
			<select id="dirctor" name ="director" style="width:300px">
				<option>
				<?php
					$db->query('CREATE VIEW order_director AS SELECT * FROM Director ORDER BY first, last');
					$all_director="SELECT id,first,last,dob FROM order_director;";
					$select_Director=$db->query($all_director);
					$db->query('DROP VIEW order_director');
			
					while ($resultdirector = $select_Director->fetch_assoc()) {	
						// $director_full_name = $resultdirector['last'].', '.$resultdirector['first'];
						echo '<option value="'.$resultdirector['id'].'">'.$resultdirector['first'].' '.$resultdirector['last'].'('.$resultdirector['dob'].')'.'</option>';
					}
				?>
			</SELECT>
            <br>
			<button type="submit" class="hollow button">Add!</button><br/><br/>
	  
			
		</div>

	
	</form>

<?php
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $movie_id = $_GET['movie'];
		$director_id = $_GET['director'];
    }
    // echo "$movie_name, $movie_rating, $movie_comment" ;

	$insert = "INSERT INTO MovieDirector VALUES('$movie_id', '$director_id');";
	// echo "$insert <br>";
	$db->query($insert);
	$db_close();
	
?>
</body>
</html>