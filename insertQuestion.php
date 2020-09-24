<?php
require 'sessions-start.php'; 
try {
 //open the sqlite database file
 $db = new PDO('sqlite:./myDB/MasteryGrading.db');
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Check if inputs are empty
$required = array('mq_num', 'cat_id');
//Loop over field names, make sure each one exists and is not empty
$error = false;

$quizNum = $_POST['mq_num'];
$catID = $_POST['cat_id'];

foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}


if ($error) { //If field is empty then send user back to the drawing board.
  header("Location: quizQuestions.php");
} 


$stmt = $db->prepare("INSERT INTO QuizQuestions VALUES (:mqnum, :catid, :qtype, :difficulty)");
$stmt->bindParam(':mqnum', $_POST['mq_num']);
$stmt->bindParam(':catid', $_POST['cat_id']);
$stmt->bindParam(':qtype', $_POST['type']);
$stmt->bindParam(':difficulty', $_POST['difficulty']);
$stmt->execute();

 //disconnect from database
 $db = null;
 }
catch(PDOException $e)
 {
 die('Exception : '.$e->getMessage());
 }
//redirect user to another page
header("Location: viewQuiz.php?mq_num=$quizNum");

?>
