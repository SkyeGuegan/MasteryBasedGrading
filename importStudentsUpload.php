<?php 
    try{
        //open the sqlite database file
        $db = new PDO('sqlite:./myDB/MasteryGrading.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['submit'])) {
        //Oh hey, they clicked the submit button. do this vv
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name']; //get name of the file 
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileErr = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        //We only want to accept .txt and .csv

        $fileExt = explode('.', $fileName); //seperate file name by .
        $fileActualExt = strtolower(end($fileExt)); //get extention end-> get last item in array

        $allowed = array('txt', 'csv');


        $openedFile = fopen($fileTmpName, "r"); //(fileName to, read)

        if($fileActualExt == 'txt') {//TEXT FILE
            while (!feof($openedFile)) { //reading file line by line
            $content = fgets($openedFile);
             //print("printing last element of $content" . array_pop(array_reverse($content)));
            //$carray = explode(' ', $content);
            $parts = preg_split('/\s+/', $content);
            if($parts[0] == ("ID")) {

            }
            else {
                //echo ($parts[0]);
                if($parts[0] != null) {
                    $studentID = $parts[0];
                //split part 1 up to get last names and first names
                $splitEmUp = preg_split ("/\,/", $parts[1]);
                $lName = substr($splitEmUp[0], 1);
                $fName = substr($splitEmUp[1], 0, (strlen($splitEmUp[1]) -1));
                //echo ("part1: ".$parts[1]);
                echo "<br>";
                echo "Student ID: ".$studentID;
                echo "lName: ". $lName;
                echo "fName: ". $fName;
                echo "<br>";
                //^ToDo, make preview of generation. What if they uploaded the wrong student file?

                $stmt = $db->prepare("INSERT INTO Student VALUES (:id, :lname, :fname)");
//}
                    $stmt->bindParam(':id', $studentID);
                    $stmt->bindParam(':fname', $lName);
                    $stmt->bindParam(':lname', $fName);
                    $stmt->execute();
                }
            }
        }
        }
        elseif ($fileActualExt == 'csv') {
            $firstLine = true;
            while (!feof($openedFile)) { //reading file line by line
                
                $content = fgets($openedFile);

                $parts = preg_split('/\s+/', $content);
            if($firstLine == true) {
                //do nothing
                $firstLine = false;
            }
            else {
                if($parts[0] != null) {
                    $studentID = $parts[0];

                //split part 1 up to get last names and first names
                $splitEmUp = preg_split ("/\,/", $parts[0]);
                $studentID = $splitEmUp[0];
                $lName = substr($splitEmUp[1], 1);
                $fName = substr($splitEmUp[2], 0, (strlen($splitEmUp[1]) -1));

                echo "<br>";
                echo "Student ID: ".$studentID;
                echo "lName: ". $lName;
                echo "fName: ". $fName;

                //print("Parts: " . $parts[0]);
                echo "<br>";

                $stmt = $db->prepare("INSERT INTO Student VALUES (:id, :lname, :fname)");
//}
                    $stmt->bindParam(':id', $studentID);
                    $stmt->bindParam(':fname', $lName);
                    $stmt->bindParam(':lname', $fName);
                    $stmt->execute();
                }
            }


        }
        }
        else{
            include 'headers.php';
            echo "The uploaded file is not supported";
        }

    }

        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    //redirect user to another page
    header("Location: viewStudents.php?success=1");
?>