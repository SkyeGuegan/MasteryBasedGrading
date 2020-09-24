	<?php
	require 'sessions-start.php';
	try {
		
	 //open the sqlite database file
	 $db = new PDO('sqlite:./myDB/MasteryGrading.db');
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(isset($_POST['Submit'])) {
		$input = $_POST['userInput'];
		// If input is the same then delete 
		if($input != "DELETE") {
			header("Location: clearData.php");
		}
		else {
			$db->exec('DELETE FROM Student;');
			$db->exec('DELETE FROM Quiz;');
		}
		

		}
	 //disconnect from database
	 $db = null;
	 }
	catch(PDOException $e)
	 {
	 die('Exception : '.$e->getMessage());
	 }	 
?>

<!DOCTYPE html>
<html>
<head>
	<title>CLEAR DATA</title>
	
</head>
<body>
	<h1>CLEAR DATA</h1>
	<?php include 'headers.php';?>
	<h3>
		Are you sure you want to do this?
	</h3>
	<p>This action will do the following things</p>
		<ul>
			<li>Delete ALL students from the database</li>
			<li>Delete ALL quizes currently entered</li>
		</ul>
	<p></p>
	<p>This action will NOT do the following things</p>
	<ul>
		<li>Delete Learning Targets (found in Misc.)</li>
	</ul>
	
		
	<script type="text/javascript">
	</script>
	<form  action="" method="post">
		<input type="text" placeholder="Type DELETE to confirm" name="userInput" required>
		<input type="submit" name="Submit">
	</form>

</body>
</html>