<?php
$msg = "";
try {
 //open the sqlite database file
 $db = new PDO('sqlite:./myDB/MasteryGrading.db');
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Check if inputs are empty
$required = array('f_name', 'l_name', 'student_ID');
//Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}
if ($error) {
	$msg = "Please enter all fields";
  header("Location: updateStudentForm.php");
}


echo $msg;
$firstName = $_POST['f_name'];
$lastName = $_POST['l_name'];
$student_ID = $_POST['student_ID'];	
/*Doesnt change the primary key...*/
$stmt = $db->prepare("UPDATE Student SET studentId = :studentId, fname=:fname, lname=:lname WHERE studentId=" . $_POST['student_ID']);
$stmt->bindParam(':studentId', $_POST['student_ID']);
$stmt->bindParam(':fname', $_POST['f_name']);
$stmt->bindParam(':lname', $_POST['l_name']);

$stmt->execute();




 //disconnect from database
 $db = null;
 }
catch(PDOException $e)
 {
 die('Exception : '.$e->getMessage());
 }
//redirect user to another page
header("Location: viewStudents.php?success=1");

?>
