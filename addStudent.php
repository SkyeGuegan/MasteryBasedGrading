<?php require 'sessions-start.php'; 

	if ( isset($_GET['success']) && $_GET['success'] == 1 ){
                echo "Success! :)";
            }
?>

<!DOCTYPE html>
<html>
<head>
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

        input {
            width: 85%;
        }

        #subsub {
            margin-top: 10px;
            margin-left: 10%;
        }
    </style>
	<title>Add a Student</title>
</head>
<body>
	<h1 align="center">Add a Student</h1>
	<?php include 'headers.php'; ?>
    <div class="inputForm">
        <form action="/~dbteam/insertStudentIntoDB.php" method="post">
            <div>
            <fieldset style="">

                <legend><strong>Student Information</strong></legend>

                        <div class="content">
                            <div>
                                <label>First name:</label>
                                <input type="text" name="f_name" placeholder="Student's First Name" required>
                            </div>
                            <div>
                                <label>Last name:</label>
                                <input type="text" name="l_name" placeholder="Student's Last Name" required="Please enter student's last name">
                            </div>
                            <div>
                                <label>Student ID:</label>
                                <input type="text" name="student_ID" placeholder="Student's ID"required>
                            </div>
                            <input id="subsub" type="submit" value="Submit">
                        </div>
                    
            </fieldset>
            </div>
        </form>
    </div>
	
</body>
</html>
