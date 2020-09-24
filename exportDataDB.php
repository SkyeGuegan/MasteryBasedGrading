<?php require 'sessions-start.php'; 

    if(isset($_POST["export"])) {
        $db_file = './myDB/MasteryGrading.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            header('Content-Type: text/csv; charset=utf-8');    //type of file is goint to be written
            $name = 'exportedStudentGrades'.date('m-d-Y_hia').'.csv';
            //header('Content-Disposition: attachment; filename=data.csv');
            header('Content-Disposition: attachment; filename='.$name);
            $output = fopen("php://output", "w");   //write to file
            fputcsv($output, array('Last Name', 'First Name', 'ID', 'MQ', 'TargetCat', 'Rating', 'Type', ' Due Date', 'Difficulty'));

            $result_set = $db->query("With q as (SELECT Quiz.MQ as mq1, Quiz.type as type1, dueDate, catID, difficulty FROM Quiz, QuizQuestions Where Quiz.MQ = QuizQuestions.MQ AND Quiz.type = QuizQuestions.type), g as (SELECT mq1 as mq2, type1 as type2, dueDate, q.catID, difficulty, studentID, rating, notes FROM q LEFT JOIN StudentGrade ON StudentGrade.MQ = q.mq1 AND StudentGrade.catID = q.catID) SELECT lname, fname, Student.studentID as ID, g.mq2 as MQ, g.catID as TargetCat, rating, g.type2 as type, dueDate, difficulty FROM Student LEFT JOIN g ON Student.studentID = g.studentID;");


            foreach($result_set as $tuple) {
                $array = array($tuple['lname'], $tuple['fname'], $tuple['ID'], $tuple['MQ'], $tuple['TargetCat'], $tuple['rating'], $tuple['type'], $tuple['dueDate'], $tuple['difficulty'] );  //write these tuples to file
                fputcsv($output, $array);
            }

            fclose($output);

            $db = null;
                    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    }
?>
