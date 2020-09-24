<?php require 'sessions-start.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Grades</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <!-- Bootstrap core CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
  
    <style>
  
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid black;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: white;
}

</style>
</head>
<body>
    <div id="header">
		<h1 align="center" > View Grades</h1>
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

            //echo  "<fieldset>";
            echo" <form action='/~dbteam/viewGrades.php'>";
            echo" Select Student:  <select name='Student'> ";
            foreach($result_set as $tuple) {
              echo " <option value='$tuple[studentId]'";
              if(isset($_GET['Student'])){if($tuple['studentId']==$_GET['Student']) echo "selected";}
              echo">$tuple[fname] $tuple[lname] </option>";
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
              <input type='submit'>
              </form><br>";
              //echo  "</fieldset><br>";

            if(isset($_GET['Quiz'])){
             //return all passengers, and store the result set
            //$query_str = "select * from passengers where ssn='$_GET[passenger_ssn]';"; SHOW SPECFIC
            $query_str = "select * from Student NATURAL JOIN StudentGrade NATURAL JOIN QuizQuestions WHERE MQ=$_GET[Quiz] AND studentId=$_GET[Student];";
            $result_set = $db->query($query_str);

            //loop through each tuple in result set and print out the data
            //ssn will be shown in blue (see below)
            echo "<table>
            <tr>
              <th>Name</th>
              <th>Quiz</th>
              <th>Category ID</th>
              <th>Difficulty</th>
              <th>Grade</th>
              <th>Type</th>
              <th>Notes</th>
              <th> Update Row </th>
            </tr>";
            foreach($result_set as $tuple) {
                 echo"<tr> 
                 <td>$tuple[fname] $tuple[lname] </td>
                 <td>$tuple[MQ] </td>
                 <td>$tuple[catID] </td>
                 <td>$tuple[difficulty] </td>
                 <td>$tuple[rating] </td>
                 <td>$tuple[type]</td>
                 <td>$tuple[notes]</td>
                 <td><a href=\"http://129.114.104.163/~dbteam/updateGradesForm.php?studentId=$tuple[studentId]&MQ=$tuple[MQ]&catID=$tuple[catID]\">(update)</a><br></td>
                    </tr>";
            }
           echo "</table>";
          }   

            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
</body>
</html>