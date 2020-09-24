<?php require 'sessions-start.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>view Learning Targets</title>
    <style type="text/css">

        table {
            margin-top: 5px auto;
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
        .catID {
            width: 100px;
        }

    </style>
</head>
<body>
	<h1>View Learning Targets</h1>
	<?php include 'headers.php';
	$db_file = './myDB/MasteryGrading.db';
	try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query_str = "SELECT * FROM Category;";
            $result_set = $db->query($query_str);

            echo '<table>';
            //echo "<caption>Students</caption>";
            echo "<thead>";
            echo "   <tr class=\"header1\">";
            /*
                echo "<colgroup>";
                    echo "<col span='2' style='background-color:red'>";
                    echo "<style='background-color:blue'>";
                echo "</colgroup>";
                */
                echo "<th class=\"catID\">Category ID</th>";        
                echo "<th>Learning Target</th>";        
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
                 echo "<td>$tuple[catID]</td>";
                 echo "<td>$tuple[learningTarget]</td>";
                 //echo "<td><a href=\"http://129.114.104.163/~dbteam/updateStudentForm.php?studentId=$tuple[catID]\"><i class=\"material-icons\" style=\"color:#363636;\">update</i></a>";
                 //echo "   <a href=\"http://129.114.104.163/~dbteam/deleteStudentForm.php?studentId=$tuple[catID]\"><i class=\"material-icons\" style=\"color:#800000;\">delete_forever</i></a></td>";
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

</body>
</html>