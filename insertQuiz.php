<?php
require 'sessions-start.php'; 
try {
 //open the sqlite database file
 $db = new PDO('sqlite:./myDB/MasteryGrading.db');
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Check if inputs are empty
$required = array('mq_num', 'type');
//Loop over field names, make sure each one exists and is not empty
$error = false;

$quizNum = $_POST['mq_num'];
$quizType = $_POST['type'];


foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}
if ($error) { //If field is empty then send user back to the drawing board.
  header("Location: createQuiz.php");
} 


	$stmt = $db->prepare("INSERT INTO Quiz VALUES (:mqnum, :qtype, :duedate)");
$stmt->bindParam(':mqnum', $_POST['mq_num']);
$stmt->bindParam(':qtype', $_POST['type']);
$stmt->bindParam(':duedate', $_POST['due_date']);
$stmt->execute();

 //disconnect from database
 $db = null;
 }
catch(PDOException $e)
 {
 die('Exception : '.$e->getMessage());
 }
//redirect user to another page
header("Location: quizQuestions.php?mq_num=$quizNum");

?>
