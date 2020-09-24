<?php
try {
 //open the sqlite database file
 $db = new PDO('sqlite:./myDB/MasteryGrading.db');
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Check if inputs are empty
//$required = array('f_name', 'l_name', 'student_ID');
//Loop over field names, make sure each one exists and is not empty
//$error = false;

//foreach($required as $field) {
// if (empty($_POST[$field])) {
//   $error = true;
// }
//}
//if ($error) { //If field is empty then send user back to the drawing board.
//  header("Location: addStudent.php");
//} 
	
$student = $_POST['student'];
$quiz= $_POST['quiz'];
//$type=$_POST['type'];
$i=0;
$element = 0;
$note="note".$i;
while(isset($_POST[$i])){
$name=  $i."".$element;
$grade = $_POST[$i];
$catid = $_POST[$name];
$notes = $_POST[$note];
//echo $grade;
//echo $catid;
$stmt = $db->prepare("INSERT INTO StudentGrade VALUES (:quiz, :catid, :student, :grade, :notes)");
//}
$stmt->bindParam(':quiz', $_POST['quiz']);
$stmt->bindParam(':catid', $_POST[$name]);
$stmt->bindParam(':student', $_POST['student']);
$stmt->bindParam(':grade', $_POST[$i]);
//$stmt->bindParam(':type', $_POST['type']);
$stmt->bindParam(':notes', $_POST[$note]);
$stmt->execute(); 
$i++;
};


 //disconnect from database
$db = null;
 }
catch(PDOException $e)
 {
 die('Exception : '.$e->getMessage());
 }
//redirect user to another page
header("Location: viewGrades.php?Student=$student&Quiz=$quiz");

?>