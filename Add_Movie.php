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
	<br>
	<br>
    <h3>Add new Movie</h3>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" placeholder="Title" name="title" style="width:300px">
              <label for="company">Company</label>
              <input type="text" placeholder="Company" name="company" style="width:300px">
              <label for="year">Year</label>
              <input type="text" placeholder="Year" name="year" style="width:300px">
            </div>
            <div class="form-group">
                <label for="rating">MPAA Rating</label>
                <select name="rate" style="width:300px">
                    <option value="G">G</option>
                    <option value="NC-17">NC-17</option>
                    <option value="PG">PG</option>
                    <option value="PG-13">PG-13</option>
                    <option value="R">R</option>
                    <option value="surrendere">surrendere</option>
                </select>
            </div>
            <div class="form-group">
                <label >Genre:</label>
                <input id="genre1" type="checkbox" name="genre[]" value="Action"><label for="genre1">Action</label>
                <input id="genre2" type="checkbox" name="genre[]" value="Adult"><label for="genre2">Adult</label>
                <input id="genre3" type="checkbox" name="genre[]" value="Adventure"><label for="genre3">Adventure</label>
                <input id="genre4" type="checkbox" name="genre[]" value="Animation"><label for="genre4">Animation</label>
                <input id="genre5" type="checkbox" name="genre[]" value="Comedy"><label for="genre5">Comedy</label>
                <input id="genre6" type="checkbox" name="genre[]" value="Crime"><label for="genre6">Crime</label><br>
                <input id="genre7" type="checkbox" name="genre[]" value="Documentary"><label for="genre7">Documentary</label>
                <input id="genre8" type="checkbox" name="genre[]"  value="Drama"><label for="genre8">Drama</label>
                <input id="genre9" type="checkbox" name="genre[]" value="Family"><label for="genre9">Family</label>
                <input id="genre10" type="checkbox" name="genre[]"  value="Fantasy"><label for="genre10">Fantasy</label>
                <input id="genre11" type="checkbox" name="genre[]" value="Horror"><label for="genre11">Horror</label>
                <input id="genre12" type="checkbox" name="genre[]"  value="Musical"><label for="genre12">Musical</label><br>
                <input id="genre13" type="checkbox" name="genre[]"  value="Mystery"><label for="genre13">Mystery</label>
                <input id="genre14" type="checkbox" name="genre[]"  value="Romance"><label for="genre14">Romance</label>
                <input id="genre15" type="checkbox" name="genre[]"  value="Sci-Fi"><label for="genre15">Sci-Fi</label>
                <input id="genre16" type="checkbox" name="genre[]" value="Short"><label for="genre16">Short</label>
                <input id="genre17" type="checkbox" name="genre[]"  value="Thriller"><label for="genre17">Thriller</label>
                <input id="genre18" type="checkbox" name="genre[]"  value="War"><label for="genre18">War</label>
                <input id="genre19" type="checkbox" name="genre[]"  value="Western"><label for="genre19">Western</label>
            </div>
            <button type="submit" class="hollow button">Add!</button>
        </form>
        
          
    
   <?php
        $query = "SELECT id FROM MaxMovieID;";
        $db = new mysqli('localhost', 'cs143','','CS143'); //connect to database
        if($db->connect_errno > 0){
          die('Unable to connect to database [' . $db->connect_error . ']');
        }
        if($_SERVER["REQUEST_METHOD"]=="GET"){
          $company= $db->real_escape_string($_GET['company']);
          $rating = $_GET['rate'];
          $title = $db->real_escape_string($_GET['title']);
          $year = $_GET['year'];
        }
        // echo "$company, $rate, $title, $year";
        // echo "Connected!<br>";
        $rs = $db->query($query);
        $row = $rs->fetch_row();
        $id = current($row);

        //update MaxMovieID
        if($rs && $title && $year){
            $newid = $id+1;
            $add_movie = "INSERT INTO Movie VALUES($newid,'$title',$year,'$rating','$company');";
            // echo "$add_movie <br>";
            $db->query($add_movie);
            $update_id = "UPDATE MaxMovieID SET id=$newid;";
            $db->query($update_id);
    
            //insert movie into different category according to its genre
           
            if(!empty($_GET['genre'])) {
              foreach($_GET['genre'] as $check) {
                // echo "$check <br>"; 
                $insert1 = "INSERT INTO MovieGenre VALUES($newid, '$check');";
                // echo "$insert1 <br>";
                $db->query($insert1);

              }
            }
            echo "Movie ".$title. " is added! <br>";
            $db_close();
        }
              
         

   ?>

</body>
</html>