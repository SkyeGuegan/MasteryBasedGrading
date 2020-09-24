<?php require 'sessions-start.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload Students</title>
	<style type="text/css">
		html {
			height: 100%;
			width: 100%;
		}
		.table {
			background: #f9f9f9;
                border-spacing: initial;
                margin: 100px auto;
                /*word-break: break-word;*/
                position: relative;
                color: #333;
                border-radius:  8px;
                padding: 20px;
                width: 380px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);;
                border: 2px solid;
                border-style: double;
                border-color: #800000; 
		}
	</style>
</head>
<body>
	
	<h1 align="center">Import Students</h1>
	<?php include 'headers.php'; ?>

	<div class="table">
		<form action="importStudentsUpload.php" method="POST" enctype="multipart/form-data"> <!-- you need enctype to pass file-->
		
		<input type="file" accept=".txt,.csv" name="file"/> <!--Check what files are okay to upload// https://stackoverflow.com/questions/4328947/limit-file-format-when-using-input-type-file-->
		<button type="submit" name="submit">Import Students</button>
	</form>
	</div>

</body>
</html>
