<?php require 'sessions-start.php'; ?>

<!DOCTYPE html>
<html>
<body>
    <h1 align="center">Update Grade</h1>
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
            $query_str = "SELECT * FROM Student NATURAL JOIN StudentGrade NATURAL JOIN QuizQuestions WHERE studentId='$_GET[studentId]' AND MQ='$_GET[MQ]' AND catID='$_GET[catID]';";
            $result = $db->query($query_str);

            $student_ID = $fname = $lname = $MQ = $catID = $difficulty = $rating = $type = $notes =  ""; //global var for html to use
            foreach ($result as $tuple) {
                //echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]<br/>\n"; Nice for debugging
                $student_ID = $tuple["studentId"];
                $fname = $tuple["fname"];
                $lname = $tuple["lname"];
                $MQ = $tuple["MQ"]; 
                $catID = $tuple["catID"]; 
                $difficulty = $tuple["difficulty"]; 
                $rating = $tuple["rating"]; 
                $type = $tuple["type"];
                $notes = $tuple["notes"];
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

    <form action="/~dbteam/updateGradeDB.php" method="post">
        <fieldset>
            <legend>Update Student Grade</legend>
            First name:
            <?php echo $fname?>
            <br>
            Last name:
            <?php echo $lname?>
            <br>
            StudentID:
            <input type="hidden" name="studentID"  value="<?php echo $student_ID?>">
            <?php echo $student_ID?>
            <br>
            Quiz:
            <input type="hidden" name="MQ"  value="<?php echo $MQ?>">
            <?php echo $MQ?>
            <br>
            Category ID:
            <input type="hidden" name="catID"  value="<?php echo $catID?>">
            <?php echo $catID?>
            <br> 
            Difficulty:
            <?php echo $difficulty?>
            <br>
            Type:
            <?php echo $type?>
            <br> 
            Grade:
            <br>
            <!-- <input type="text" name="Rating" placeholder="Rating" value="<?php //echo $rating?>" required> -->
            <input name='rating' type='radio' value='E' <?php if($rating == 'E') echo 'checked'; ?>>E</input>
            <input name='rating' type='radio' value='M' <?php if($rating == 'M') echo 'checked'; ?>>M</input>
            <input name='rating' type='radio' value='P' <?php if($rating == 'P') echo 'checked'; ?>>P</input>
            <input name='rating' type='radio' value='X' <?php if($rating == 'X') echo 'checked'; ?>>X</input>
            <input name='rating' type='radio' value='N' <?php if($rating == 'N') echo 'checked'; ?>>N</input>
            
            <br> 
            Notes:
            <br>
            <!-- <input type="text" name="Notes" placeholder="Notes" value="<?php //echo $notes?>" required> -->
            <textarea rows='2' cols='50' name='notes' placeholder='Notes'><?php echo $notes?></textarea>
            <br>
            <input type="submit" value="Submit">

        </fieldset>
    </form>
</body>

</html>
