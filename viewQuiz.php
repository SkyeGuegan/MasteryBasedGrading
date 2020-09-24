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
  <h1>View Quizzes</h1>
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

            if (empty($_GET)) {
              $query_str = "select * from QuizQuestions order by MQ;";
            }
            else {
              $query_str = "select * from QuizQuestions where MQ='$_GET[mq_num]' order by MQ;";
            }
            $result_set = $db->query($query_str);

            //loop through each tuple in result set and print out the data
            //ssn will be shown in blue (see below)
            echo "<table>
            <tr>
              <th>Quiz Number</th>
              <th>Catagory ID</th>
              <th>Type</th>
              <th>Difficulty</th>
            </tr>";
            foreach($result_set as $tuple) {
                 echo"<tr> 
                 <td>$tuple[MQ] </td>
                 <td>$tuple[catID] </td>
                 <td>$tuple[type] </td>
                 <td>$tuple[difficulty]</td>
                    <tr>";
            }
            if (!empty($_GET)) {
              echo "   <a href=\"http://129.114.104.163/~dbteam/quizQuestions.php?mq_num=$_GET[mq_num]\">(add another question)</a><br>";
            }
            
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
