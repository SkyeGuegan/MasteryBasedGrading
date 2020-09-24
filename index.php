<?php require 'sessions-start.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Mastery Grading</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
</style>
</head>
<body>
	<div id="header">
		<h1 align="center" >Welcome <?php echo ($_SESSION['username']); ?>!</h1>
	</div>
	<?php require 'headers.php'; ?>
	<br>
	<img src="db.png" class="center" >
</body>
</html>
