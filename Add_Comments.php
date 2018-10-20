<!DOCTYPE html>
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
	<h3>Add new comment:</h3>
	<form method = "GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<div class="large-10 columns">
			Please fill in the following information:<br><br>
			<!-- without rolldown list -->
			<!-- Movie Name: <input type = "text" name ="movie"><br><br> -->
			<label>Movie Title: </label>
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
					$query_selectmovie=$db->query($all_movie);
			
					while ($resultmovie = $query_selectmovie->fetch_assoc()) {	
						// if ($_GET['mid']){
						// 	// echo $_GET['mid'];
						// 	if ($resultmovie['id'] == $mid) {
						// 		echo $_GET['mid'];
						// 		echo '<option value="'.$resultmovie['title'].'" selected = "true">'.$resultmovie['title'].'('.$resultmovie['year'].')'.'</option>';
						// 	}
						// 	else
						// 		echo '<option value="'.$resultmovie['title'].'" id="'.$resultmovie['id'].'">'.$resultmovie['title'].'('.$resultmovie['year'].')'.'</option>';
						// }
						// else {
							echo '<option value="'.$resultmovie['id'].'">'.$resultmovie['title'].'('.$resultmovie['year'].')'.'</option>';
						// }
					}
				?>
			</select>

			<label for="rating">Rating (from 1 to 5):</label>
			<select name="rating" style="width:250px">
				<option value="5">5</option>
				<option value="4">4</option>
				<option value="3" selected="true">3</option>
				<option value="2">2</option>
				<option value="1">1</option>
			</select><br/>

	      	<label>Your name:
	        	<input type="text" name="name" style="width:250px" value="<?php echo 'Mr. Anonymous'?>" placeholder="Enter your name" />
	      	</label>

		  	<b>Please add your comments in the below text area:</b><br>
			<textarea rows="10" cols="60" name="comment" style="width:600px;height:180px;"></textarea>
			<button type="submit" class="hollow button">Add!</button>
		</div>
	  
	</form>

	<?php
        if($_SERVER["REQUEST_METHOD"]=="GET"){
        	$reviewer_name = $db->real_escape_string($_GET['name']);
            $movie_id = $_GET['movie'];
			$movie_rating = $_GET['rating'];
			$movie_comment = $db->real_escape_string($_GET['comment']);
        }
        // echo "$movie_name, $movie_rating, $movie_comment" ;
        
		$movie_time = "SELECT now()";
		$time_now = $db->query($movie_time)->fetch_array();
	

		$insert = "INSERT INTO Review VALUES('$reviewer_name', '$time_now[0]', '$movie_id', $movie_rating, '$movie_comment');";
		// echo "$insert <br>";
		if ($db->query($insert)) {
			echo "Your comment is added successfully!<br>" ;
			echo "$time_now[0] <br>";
		}

		$db_close();
	?>
	<br>
	<br>
	<hr/>
</body>
</html>