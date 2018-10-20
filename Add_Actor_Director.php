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
	<h3>Add new Actor/Director</h3>
	<div>
    <form method = "GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
       <label class="large-6 columns">
            <input type="radio" checked="checked" name="identity" id="actor" value = "Actor" />Actor
        </label>
        <label class="large-6 columns">
            <input type="radio" name="identity" id="director" value="Director"/>Director
        </label>
        <div class="large-12 columns">
          <label>First Name
            <input type="text" placeholder="First Name" name="fname" style="width:300px"/>
          </label>
        </div>
        <div class="large-12 columns">
          <label>Last Name
            <input type="text" placeholder="Last Name" name="lname" style="width:300px"/>
          </label>
        </div>
        <label class="large-6 columns">
            <input type="radio" name="sex" checked="checked" value="male">Male
        </label>
        <label class="large-6 columns">
            <input type="radio" name="sex" value="female">Female
        </label>
        <div class="large-10 columns">
          <label>Date of Birth <br>ie: 1997-05-05</label>
          <input type="text" placeholder="DOB" name="dateb" style="width:300px">
        </div>
        <div class="large-10 columns">
          <label for="DOD">Date of Die (leave blank if alive now)</label>
          <input type="text" placeholder="DOD" name="dated" style="width:300px">
        </div>
        <button type="submit" class="hollow button">Add!</button>
    </form>
    </div>
    <?php
          // update MaxPersonID table
      $query = "SELECT id FROM MaxPersonID;";
      $db = new mysqli('localhost', 'cs143','','CS143'); //connect to database
      if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
      }
            
      if($_SERVER["REQUEST_METHOD"]=="GET"){
          $fname = $db->real_escape_string($_GET['fname']);
          $lname = $db->real_escape_string($_GET['lname']);
          $sex = $_GET['sex'];
          $dateb = $_GET['dateb'];
          $dated = $_GET['dated'];
      }
      // echo "$fname, $lname, $sex, $dateb, $dated" ;
    
      // $db->select_db("CS143");
      $rs = $db->query($query);
      $row = $rs->fetch_row();
      $id = current($row);
      
      if($rs && $fname && $lname && $sex && $dateb){
          $newid = $id+1;
          //update MaxMovieID
          $update_query = "UPDATE MaxPersonID Set id = $newid;";
          $db->query($update_query);

          if ($dated == '') {
            $dated == NULL;  
          }

          if($_GET['identity'] == "Actor"){
            if ($dated == '') {
              $insert = "INSERT INTO Actor VALUES($newid, '$lname', '$fname', '$sex', '$dateb', NULL);";
              // $dated == NULL;  
            } 
            else {
              $insert = "INSERT INTO Actor VALUES($newid, '$lname', '$fname', '$sex', '$dateb', '$dated');";
            }
              // echo "$insert <br>";
              $db->query($insert);
              echo "Actor ".$lname. " ". $fname." is added!<br>";
          }
          if($_GET['identity'] == "Director"){
            if ($dated == '') {
              $insert = "INSERT INTO Director VALUES($newid,'$lname','$fname', '$dateb', NULL);";
            }
            else {
              $insert = "INSERT INTO Director VALUES($newid,'$lname','$fname', '$dateb', '$dated');";
            }
            // echo "$insert <br>";
            $db->query($insert);
            echo "Director ".$lname. " ". $fname." is added!<br>";
          }
          $db_close();
      }
          
                  
    ?>
</body>
</html>