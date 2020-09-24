<?php require 'sessions-start.php'; 

        //path to the SQLite database file
        $db_file = './myDB/MasteryGrading.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return all Students and store the result. Make sure to include students who haven't taken any tests.
            $result_set = $db->query("With q as (SELECT Quiz.MQ as mq1, Quiz.type as type1, dueDate, catID, difficulty FROM Quiz, QuizQuestions Where Quiz.MQ = QuizQuestions.MQ AND Quiz.type = QuizQuestions.type), g as (SELECT mq1 as mq2, type1 as type2, dueDate, q.catID, difficulty, studentID, rating, notes FROM q LEFT JOIN StudentGrade ON StudentGrade.MQ = q.mq1 AND StudentGrade.catID = q.catID) SELECT lname, fname, Student.studentID as id, g.mq2 as MQ, g.catID as TargetCat, rating, g.type2 as type, dueDate, difficulty FROM Student LEFT JOIN g ON Student.studentID = g.studentID ORDER BY MQ;");

            echo "<h1 align=\"center\">Export Data</h1>";
            include 'headers.php';
            echo "<form method=\"POST\" action=\"exportDataDB.php\">";
            echo " <input type=\"submit\" name=\"export\" value=\"CSV export\" align=\"center\"/>";
            echo "</form>";
            echo "<h3 align=\"center\"> Preview of CSV </h3>";

            //Genereate preview below    
            echo '<table>';
            echo "<thead>";
            echo "   <tr class=\"header1\">";
                echo "<th>Last Name ID</th>";        
                echo "<th>First Name</th>";        
                echo "<th>ID</th>";
                echo "<th>MQ</th>";
                echo "<th>TargetCat</th>";
                echo "<th>Rating</th>";
                echo "<th>Type</th>";
                echo "<th>Due Date</th>";
                echo "<th>Difficulty</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach($result_set as $tuple) {


                echo "<tr>";
                echo "<td>$tuple[lname]</td>";
                echo "<td>$tuple[fname]</td>";
                echo "<td>$tuple[id]</td>";
                echo "<td>$tuple[MQ]</td>";
                echo "<td>$tuple[TargetCat]</td>";
                echo "<td>$tuple[rating]</td>";
                echo "<td>$tuple[type]</td>";
                echo "<td>$tuple[dueDate]</td>";
                echo "<td>$tuple[difficulty]</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            $db = null;

        }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
?>
<!DOCTYPE html>
<html>
<script type="text/javascript">

</script>

<head>
	<title>Export Data</title>
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

        h3 {
            font-size: 20px;
        }

        input {
            padding: 20px;
            width: 100%;
            background-color: #800000;
            color: white;
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
    

</body>
</html>
