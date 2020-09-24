<?php require 'sessions-start.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Mastery Grading</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style type="text/css">

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            /*border: 1px solid black;*/
            text-align: left;
            padding: 8px;
            
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .tab {
            /*padding-top: 3px;*/
        }
        .header1 {
            background-color: #f9f9f9;
        }

        .action {
            width: 60px;
            color: #f9f9f9;
            text-align: center;
            background-color:#606060;
        }

        .action a {
            align-items: center;
        }

        .material-icons {
            color: #f9f9f9;
        }
    </style>
</head>
<body>
  <h1>View Students</h1>
  <?php include 'headers.php'; ?>

  <?php

        //path to the SQLite database file
        $db_file = './myDB/MasteryGrading.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return all Students and store the result set
            //$query_str = "select * from Students
            $query_str = "select * from Student;";
            $result_set = $db->query($query_str);

            echo '<table>';
            //echo "<caption>Students</caption>";
            echo "<thead>";
            echo "   <tr class=\"header1\">";
                echo "<th>Student ID</th>";        
                echo "<th>Last Name</th>";        
                echo "<th>First Name</th>";
                echo "<th class='action'>Action</th>";
                //echo "<th>Delete</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            //loop through each tuple in result set and print out the data
            //ssn will be shown in blue (see below)
            foreach($result_set as $tuple) {
                echo "<div class=\"tab\">";
                echo "<tr>";
                echo "<td>$tuple[studentId]</td>";
                echo "<td>$tuple[lname]</td>";
                echo "<td>$tuple[fname]</td>";
                echo "<td><a href=\"http://129.114.104.163/~dbteam/updateStudentForm.php?studentId=$tuple[studentId]\"><i class=\"material-icons\" style=\"color:#363636;\">update</i></a>";
                echo "<a href=\"http://129.114.104.163/~dbteam/deleteStudentForm.php?studentId=$tuple[studentId]\"><i class=\"material-icons\" style=\"color:#800000;\">delete_forever</i></a></td>";


                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            if ( isset($_GET['success']) && $_GET['success'] == 1 ){
                // treat the succes case ex:
                echo "Success! :)";
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
