<?php require 'sessions-start.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Grades</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <!-- Bootstrap core CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
  
<style>
</style>
</head>
<body>
    <div id="header">
		<h1 align="center" > Grade</h1>
	</div>

	<?php require 'headers.php'; ?>
<br>
    <?php
        //path to the SQLite database file
        $db_file = './myDB/MasteryGrading.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

             //return all passengers, and store the result set
            //$query_str = "select * from passengers where ssn='$_GET[passenger_ssn]';"; SHOW SPECFIC
            $query_str = "select * from Student ORDER BY lname;";
            $result_set = $db->query($query_str);
            $query_str2 = "select Distinct MQ from Quiz ORDER BY MQ;";
            $result_set2 = $db->query($query_str2);

            echo  "<fieldset>";
            echo" <form action='/~dbteam/EnterGrades2.0.php'>";
            echo" Select Student:  <select name='Student'> ";
            foreach($result_set as $tuple) {
              echo " <option value='$tuple[studentId]'";
              if(isset($_GET['Student'])){if($tuple['studentId']==$_GET['Student']) echo "selected";}
              echo">$tuple[fname] $tuple[lname]</option>";
            } 
            echo"</select>
            <br><br>
            Select Mastery Quiz Number: <select name='Quiz'> ";
            foreach($result_set2 as $tuple2) {
              echo "<option value='$tuple2[MQ]'";
              if(isset($_GET['Quiz'])){if($tuple2['MQ']==$_GET['Quiz']) echo "selected";}
              echo">$tuple2[MQ]</option>";
            } 
            echo"
              </select>
                <br><br>
                Quiz type:
                <input name='qtype' type='radio' value='IC'>In class quiz</input>
                <input name='qtype' type='radio' value='TH'>Take home quiz</input>
                <br><br>
              <input type='submit'>
              </form><br>";
              echo  "</fieldset><br>";

            

            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
</body>
</html>
