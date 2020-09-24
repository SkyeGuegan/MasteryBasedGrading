<?php require 'sessions-start.php'; ?>

<!DOCTYPE html>
<html>
<style>
            table {
            border-collapse: collapse;
            width: 100%;
            }
            th, td {
            text-align: left;
            border-bottom: 1px solid #ddd;
            }
        </style>
<body>
    <h1 align="center">Enter Grade</h1>
    <?php include 'headers.php'; ?>

<p>
    <?php

        //path to the SQLite database file
        $db_file = './myDB/MasteryGrading.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return all passengers, and store the result set
            //$query_str = "select * from passengers where ssn='$_GET[passenger_ssn]';";       
            $query_str = "SELECT catID FROM QuizQuestions WHERE MQ = '$_GET[Quiz]' AND type = '$_GET[qtype]';";
            $result = $db->query($query_str);

            $query_str2 = "SELECT * from Student WHERE StudentID = '$_GET[Student]';";
            $result_set2 = $db->query($query_str2);

            $catID = $fname = $lname =  ""; //global var for html to use
            $a=array();

            foreach ($result as $tuple) {
                array_push($a,$tuple["catID"]);
            }
            foreach($result_set2 as $tuple2) {
            $fname=$tuple2['fname'];
            $lname=$tuple2['lname'];
            }

            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
        //right now the html is directing the form to input_form.php 
        //that means it inserting it back in not updating
    ?>

</p>

    <h1></h1>

    <form action="/~dbteam/insertGrade.php" method="post">
        <fieldset>
            <legend>Enter Student Grades</legend>
            <table border='0' style='width:75%'>
            Name: <?php echo $fname?> <?php echo $lname?>
            <input type="hidden" name="student"  value="<?php echo $_GET['Student']?>">
            <br>
            Quiz:
            <input type="hidden" name="quiz"  value="<?php echo $_GET['Quiz']?>">
            <?php echo $_GET['Quiz']?>
            <br> 
            Type:
            <input type="hidden" name="type"  value="<?php echo $_GET['qtype']?>">
            <?php echo $_GET['qtype']?>
            <br>
            <?php
            $element = 0;
            
            echo "<style>th {text-align: left;}</style>";
            echo "<tr>";
            echo "<th>Category ID</th>";
            echo "<th>Rating</th>";
            echo "<th>Notes</th>";
            echo "</tr>";
            for($i=0; $i<count($a);$i++){
            $name=  $i."".$element;
            $note="note".$i;
            echo "<tr>";
            echo "<td>";
            echo "$a[$i]:
                </td>
             <input type='hidden' name='$name'  value=$a[$i]>
             <td>
            <input name='$i' type='radio' value='E'>E</input>
            <input name='$i' type='radio' value='M'>M</input>
            <input name='$i' type='radio' value='P'>P</input>
            <input name='$i' type='radio' value='X'>X</input>
            <input name='$i' type='radio' value='N'>N</input> 
            </td>
            <td>
            <textarea rows='2' cols='50' name='$note' placeholder='Notes'></textarea>
            </td>
            </tr>
            ";
        }?>
         </table>
        <br>
            <input type='submit' value='Submit'>

        </fieldset>
    </form>
</body>

</html>
