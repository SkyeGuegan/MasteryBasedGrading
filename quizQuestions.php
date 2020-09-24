<?php require 'sessions-start.php'; 
	  include_once 'dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <style type="text/css">
        .inputForm {
            width: 96%;
            position: relative;
            top: 15px;
            left: 20px;
            font-family: arial, sans-serif;

            
        }

        .content {
            margin-bottom: 15px;
        }

        fieldset {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            background-color: #cccaca;
        }

        legend {
            padding:8px; 
            font-size: 20px;
            color: black;
            background-color: #d6d6d6;
            border: 1px solid #800000;
            box-shadow: 4px 0px 0px 0 rgba(0.2, 0, 0, 0.2), 4px 0px 0px 0 rgba(0.2, 0, 0, 0.19);
        }

        label {
            display: inline-block;
            padding: 8px;
            padding-left: 40px;
        }

        #subsub {
            margin-top: 10px;
            margin-left: 10%;
        }
    </style>
        <meta name="description" content="This is the page to add questions to a quiz">
        <meta name="author" content="Olivia">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MasteryQuestions</title>
</head>
<body>
	<div id="header">
        <h1 align="center">Add a Question</h1>
        <?php include 'headers.php';?>
    </div>
     <?php

        //path to the SQLite database file
        $db_file = './myDB/MasteryGrading.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $mq_num = "";
            $cat_id = "";
            $type = "";
            $difficulty = "";

            if (!empty($_GET)) {
              $mq_num = $_GET['mq_num'];
            }
            
            $query_str = "select Distinct MQ from Quiz;";
            $result_set = $db->query($query_str);

            $query_str2 = "select Distinct catID from Category;";
            $result_set2 = $db->query($query_str2);

            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
        //right now the html is directing the form to input_form.php 
        //that means it inserting it back in not updating
    ?>

    
    <form action="/~dbteam/insertQuestion.php" method="post">
        <div>
        <br>
        <fieldset>
            <legend><strong>Question Information</strong></legend>

            Mastery Quiz Number:  <select name='mq_num'> 
             <?php foreach($result_set as $tuple) {
               echo " <option value='$tuple[MQ]'";
               if(isset($_GET['mq_num'])){if($tuple['MQ']==$_GET['mq_num']) echo "selected";}
               echo" >$tuple[MQ] </option>";
             } ?>
            </select><span class="error">*</span>
            <br><br>
            Category ID:  <select name='cat_id'> 
             <?php foreach($result_set2 as $tuple2) {
               echo " <option value='$tuple2[catID]'>$tuple2[catID] </option>";
             } ?>
            </select><span class="error">*</span>
            <br><br>
            Type:<br>
            <input name="type" type="radio" value="IC">In class quiz</input>
            <input name="type" type="radio" value="TH">Take home quiz</input><br>
            <br>
            Difficulty:<br>
            <input name="difficulty" type="radio" value="core">Core</input>
            <input name="difficulty" type="radio" value="adv">Advanced</input><br>
            <br>
            
            <input type="submit" value="Submit">

        </fieldset>
    </div>
    </form>

</body>
</html>
