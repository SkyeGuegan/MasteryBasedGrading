<?php
//$msg = "";
try {
 //open the sqlite database file
 $db = new PDO('sqlite:./myDB/MasteryGrading.db');
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//echo $msg;
$rating = $_POST['rating'];
$notes = $_POST['notes'];	
$studentID = $_POST['studentID'];
$MQ = $_POST['MQ'];
$catID = $_POST['catID'];//needs to have the same name as the text inputs on updateStudentFrom

$stmt = $db->prepare("UPDATE StudentGrade SET rating = :rating, notes=:notes WHERE studentId=:studentID AND MQ=:MQ AND catID=:catID;");
$stmt->bindParam(':rating', $_POST['rating']);
$stmt->bindParam(':notes', $_POST['notes']);
$stmt->bindParam(':studentID', $_POST['studentID']);
$stmt->bindParam(':MQ', $_POST['MQ']);
$stmt->bindParam(':catID', $_POST['catID']);

$stmt->execute();

 //disconnect from database
$db = null;
 }
catch(PDOException $e)
 {
 die('Exception : '.$e->getMessage());
 }
//redirect user to another page
header("Location: viewGrades.php?Student=$studentID&Quiz=$MQ");

?>
