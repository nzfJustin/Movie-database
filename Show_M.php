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
  	<br><br>
  	<h3> Movie Information Page:</h3>
    <hr>
    <div>
        <label for="search_input">Search:</label>
        <form action="search.php" method ="GET">
            <input type="text" placeholder="Search by Movie name..." name="search_key">
            <input type="submit" value="Search!" class="hollow button">
        </form>
    </div>
    <?php

    $db = new mysqli('localhost', 'cs143','','CS143'); //connect to database
    if ($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    // echo "Connected to databse!<br>";

    if ($_GET['mid']){
      $id = $_GET['mid'];
      // get info from Movie 
      $M_query1 = "SELECT * FROM Movie WHERE id = $id;";
      // echo "$M_query1 <br>";
      $movie_info1 = $db->query($M_query1); // unique info
      $movie_row1 = $movie_info1->fetch_assoc();
      // get info from MovieDirector 
      $M_query2 = "SELECT first,last,dob FROM Director INNER JOIN (SELECT * FROM MovieDirector WHERE mid = $id) temp ON id = did;";
      // echo "$M_query2 <br>";
      $movie_info2 = $db->query($M_query2); // might be multiple
      // get info from MovieGenre
      $M_query3 = "SELECT * FROM MovieGenre WHERE mid = $id;";
      // echo "$M_query3 <br>";
      $movie_info3 = $db->query($M_query3); // might be multiple
      // get info from MovieActor
      $M_query4 = "SELECT first,last,role,id FROM Actor INNER JOIN (SELECT * FROM MovieActor WHERE mid = $id) temp ON id = aid;";
      // echo "$M_query4 <br>";
      $movie_info4 = $db->query($M_query4); // unique info
      // get info from Review
      $M_query5 = "SELECT * FROM Review WHERE mid = $id;";
      // echo "$M_query5 <br>";
      $movie_info5 = $db->query($M_query5); // unique info
      
    ?>
    </div>
    <hr>
    <h5>Movie Information is:</h5>
    <div>   
    <?php
        echo 'Title: ' .$movie_row1['title']. '('. $movie_row1['year'].')<br>';
        echo 'Producer: '.$movie_row1['company'].'<br>';
        echo 'MPAA Rating: '.$movie_row1['rating'].'<br>';
        echo 'Director: ';
        while($movie_row2 = $movie_info2->fetch_assoc()) {
          echo $movie_row2['first'].' '.$movie_row2['last'].'('.$movie_row2['dob'].')  ';
        }
        echo '<br>';
        echo 'Genre: ';
        while($movie_row3 = $movie_info3->fetch_assoc()) {
          echo $movie_row3[genre].' ';
        }
        echo '<br>'; ?>
    </div>
    <hr>
    <h5>Actors in this Movie:</h5>
    <div> 
    <?php
        echo "<table border='1'><tr align = left>";
        echo "<td><b>Actor</b></td>";
        echo "<td><b>Role</b></td>";
        echo "</tr>\n";

        while($movie_row4 = $movie_info4->fetch_assoc()){
          echo "<tr>";
          echo '<td><a href = "./Show_A.php?aid='.$movie_row4[id].'">'.$movie_row4[first].' '.$movie_row4[last] .'</td>';
          echo '<td>' .$movie_row4[role].'</td>';
          echo "</tr>";
        }
        echo "</table>";
    ?>
    <hr>
    <h5>User Review:</h5>
    <div> 
    <?php
        $M_query6 = "SELECT AVG(rating) AS average, COUNT(*) AS rows FROM Review WHERE mid = $id;";
        // echo "$M_query6 <br>";
        $movie_info6 = $db->query($M_query6); // unique info
        $movie_row6 = $movie_info6->fetch_assoc();
        
        echo "Average score for this Movie is ". number_format($movie_row6[average], 1, '.', '')."/5.0 based on ". $movie_row6[rows]." people's reviews.<br>";
        echo '<a href = "./Add_Comments.php?mid='. $id.'"> Leave your review!</a><br>';
    ?>
    </div>
    <hr>
    <h5>Comment detials shown below:</h5>
    <div> 
    <?php
        while($movie_row5 = $movie_info5->fetch_assoc()){
          echo '<strong>'.$movie_row5[name].'</strong> rates the this movie with score <strong>'.$movie_row5[rating].'</strong> and left a review at '.$movie_row5[time] .'<br>';
          echo 'Comment: <br>' .$movie_row5[comment].'<br><br>';
        }
 
      }
      $db_close();  
    ?>

    </div> 
    <!-- <hr><hr> -->



</body>
</html>