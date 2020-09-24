<?php
try {
 //open the sqlite database file
 $db = new PDO('sqlite:./myDB/MasteryGrading.db');
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Check if inputs are empty
$required = array('f_name', 'l_name', 'student_ID');
//Loop over field names, make sure each one exists and is not empty
$error = false;

$firstName = $_POST['f_name'];
$lastName = $_POST['l_name'];
$studentID = $_POST['student_ID'];


foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}
if ($error) { //If field is empty then send user back to the drawing board.
  header("Location: addStudent.php");
} 


//order matters (look at your schema) -- fname, mname, lname, ssn
//unprotected inserts
//$stmt = "INSERT INTO passengers VALUES
//('$_POST[f_name]', '$_POST[m_name]', '$_POST[l_name]', '$_POST[ssn]');";
// $db->exec($stmt);

// attempt 1 to protect
//$stmt = $db->prepare("INSERT INTO passengers VALUES (:f_name, :m_name, :l_name, :ssn);");
//$stmt->bindParam(':f_name', $_POST['f_name'], SQLITE3_TEXT);
//$stmt->bindParam(':m_name', $_POST['m_name'], SQLITE3_TEXT);
//$stmt->bindParam(':l_name', $_POST['l_name'], SQLITE3_TEXT);
//$stmt->bindParam(':ssn', $_POST['ssn'], SQLITE3_TEXT);
//$stmt->execute();


    

    
//attempt 2 to protect
//if(isset($_POST['ssn'])){ 
//    $stmt = $db->prepare("UPDATE passengers set f_name = :fname, m_name=:mname, l_name=:lname WHERE ssn=:ssn");
//}
//else{
	$stmt = $db->prepare("INSERT INTO Student VALUES (:id, :fname, :lname)");
//}
$stmt->bindParam(':id', $_POST['student_ID']);
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
