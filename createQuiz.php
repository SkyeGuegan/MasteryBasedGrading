<?php require 'sessions-start.php'; ?>
<!DOCTYPE html>
<html>

<head>
<title>Mastery Grading</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
</head>
<body>
	<div id="header">
        <h1 align="center" >Create a Quiz</h1>
    </div>
    <?php include 'headers.php'; ?>
    <?php
    $mq_num = "";
    $type = "";
    $due_date = "";
    if ( isset($_GET['noMQNum']) && $_GET['noMQNum'] == 1 ){    //These don't work yet
                $mq_num = "Mastery Quiz number is required.";
    }
    if ( isset($_GET['toType']) && $_GET['toType'] == 1 ){
                $type = "Type is required";
    }
    ?>
    
    <form action="/~dbteam/insertQuiz.php" method="post">
        <br>
        <fieldset>
            <legend><strong>Quiz Information</strong></legend>

            Mastery Quiz number:<br>
            <input type="text" name="mq_num" placeholder="required" required>
            <span class="error">*<?php echo $mq_num;?></span><br>
            <br>
            Quiz type (in class or take home)<br>
            <input name="type" type="radio" value="IC">In class quiz</input>
            <input name="type" type="radio" value="TH">Take home quiz</input>
            <span class="error">*<?php echo $type;?></span><br>
            <br>
            Due Date:<br>
            <input type="text" name="due_date" placeholder="not required">
            <br>
            <br>
            <input type="submit" value="Submit">

        </fieldset>
    </form>

</body>
</html>
