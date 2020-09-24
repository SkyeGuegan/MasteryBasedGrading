	<?php
	require 'sessions-start.php';
	try {
		
	 //open the sqlite database file
	 $db = new PDO('sqlite:./myDB/MasteryGrading.db');
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query_str = "SELECT * FROM Student WHERE studentId='$_GET[studentId]';";
	            $result = $db->query($query_str);

	            $student_ID = $fname = $lname = ""; //global var for html to use
	            foreach ($result as $tuple) {
	                //echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]<br/>\n"; Nice for debugging
	                $student_ID = $tuple["studentId"];
	                $fname = $tuple["fname"];
	                $lname = $tuple["lname"];
	            }


	if(isset($_POST['Submit'])) {
		$input = $_POST['userInput'];
		if($input != "DELETE") {
			header("Location: viewStudents.php");
		}
		else {
			$sql = 'DELETE FROM Student ' . 'WHERE studentId = ' . $student_ID .';';
			$db->exec('DELETE FROM Student ' . 'WHERE studentId = ' . $student_ID .';');
			header("Location: viewStudents.php");
		}


		}
	 //disconnect from database
	 $db = null;
	 }
	catch(PDOException $e)
	 {
	 die('Exception : '.$e->getMessage());
	 }



	 /**
	 * Delete Student by StudentID
	 * @param int $studentID
	 
	 fuction deleteStudent($studentID) {
	    $sql = 'DELETE FROM tasks '
	                . 'WHERE task_id = :studentID';

	    $stmt = $this->pdo->prepare($sql);
	    $stmt->bindValue(':studentID', $studentID);

	    $stmt->execute();
	 }
	 */

	 
	?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete Student</title>
	<style type="text/css">
		h3 {
			font-size: 20px;
		}

		.divs {
			width: 100%
			position: relative;
			margin: 15px auto;
			text-align: center;
		}
	</style>
</head>
<body>
	<h1>Delete Student</h1>
	<?php include 'headers.php';?>
	<h3 >
		Are you sure you want to delete the student: <?php echo $fname . " " . $lname?>, id: <?php echo $student_ID?> from the database?
	</h3>
	<script type="text/javascript">
	</script>
	<form  action="" method="post">
		<div class="divs">
			<input type="text" placeholder="Type DELETE to confirm" name="userInput" required>
			<input type="submit" name="Submit">
		</div>
		
	</form>

</body>
</html>