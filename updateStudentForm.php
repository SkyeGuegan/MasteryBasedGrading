<?php require 'sessions-start.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <style type="text/css">
        .inputForm {
            width: 96%;
            position: relative;
            top: 10px;
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
            padding:10px; 

            font-size: 20px;
            color: black;
            background-color: #d6d6d6;
            border: 1px solid #800000;
        }

        label {
            display: inline-block;
            padding: 8px;
            padding-left: 40px;
        }

        input {
            /*padding-left: 50%;*/
            width: 85%;
        }

        #subsub {
            margin-top: 10px;
            margin-left: 10%;
        }
    </style>
</head>
<body>
    <h1 align="center">Update Student</h1>
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

            $query_str = "SELECT * FROM Student WHERE studentId='$_GET[studentId]';";
            $result = $db->query($query_str);

            $student_ID = $fname = $lname = ""; //global var for html to use
            foreach ($result as $tuple) {
                $student_ID = $tuple["studentId"];
                $fname = $tuple["fname"];
                $lname = $tuple["lname"];
            }

            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>

</p>
    <div class="inputForm">
        <form action="/~dbteam/updateStudentDB.php" method="post">
            <div>
            <fieldset >

                <legend><strong>Update Student Information</strong></legend>

                        <div class="content">
                            <div>
                                <label>First name:</label>
                                <input type="text" name="f_name" placeholder="Student's First Name" value="<?php echo $fname?>" required>
                            </div>
                            <div>
                                <label>Last name: </label>
                                <input type="text" name="l_name" placeholder="Student's Last Name" value="<?php echo $lname?>" required="Please enter student's last name">
                            </div>
                            <div>
                                <label>Student ID:</label>
                                <input type="text" name="student_ID" placeholder="Student's ID" value="<?php echo $student_ID?>" required>
                            </div>
                            <input id="subsub" type="submit" value="Submit">
                        </div>
                    
            </fieldset>
            </div>
        </form>
    </div>


</body>

</html>
