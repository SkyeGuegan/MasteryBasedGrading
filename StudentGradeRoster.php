<?php
    include_once 'dbh.php';
    require 'sessions-start.php';
    echo "Quiz number: ".$_SESSION["qnum"]."<br>";
    echo "Quiz type: ".$_SESSION["qtype"]."<br>";

    //ALL FIRST NAMES
    $result2 = $db->prepare("SELECT fname FROM Student GROUP BY lname");
    $result2->execute();
    $fNames = $result2->fetchAll(PDO::FETCH_COLUMN, 0);

    //ALL LAST NAMES
    $result3 = $db->prepare("SELECT lname FROM Student GROUP BY lname");
    $result3->execute();
    $lNames = $result3->fetchAll(PDO::FETCH_COLUMN, 0);

    //CREATE A FULL NAME FOR EACH STUDENT
    for($i = 0; $i < sizeof($fNames); $i++) {
        $names[$i] = $fNames[$i] . " " . $lNames[$i];
    }
    for($i = 0; $i < sizeof($fNames); $i++) {
        $stringi = (string)$i;
        $subValue = "submit".$stringi."";
        echo $_POST[$subValue];
        if(isset($_POST[$subValue]) ) {
            echo "TEST 2";
            $result = $db->prepare("SELECT studentID FROM Student WHERE fname = :fname AND lname = :lname");
            $result->bindValue(':fname', $_SESSION["fName"]);
            $result->bindValue(':lname', $_SESSION["lName"]);
            $result->execute();

            // $_SESSION["fname"] = $fName;
            // $_SESSION["lname"] = $lName;
            $_SESSION["studentID"] = $result->fetchColumn();
            if(isset($_SESSION["studentID"]) && !empty($_SESSION["studentID"])){
                header("Location: http://129.114.104.163/~dbteam/EnterGrades.php");
            }
            else {
                echo "Invalid Student please try again";
            }
        }     
    } 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="This is the page to enter grades">
        <meta name="author" content="Spencer">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StudentGradeRoster</title>
    </head>
    <body>
        <header>
            <h1>Student Roster</h1>
            <?php include 'headers.php'; ?>
            <!-- <p><big>Choose the student whose gradew you want to enter</big></p> -->
        </header>
        <main>
            <form method="post">
                <style>th {text-align: left;}</style>
                <table border = '0' style='width:25%'>
                    <tr>
                        <th><u>Student Names</u></th>
                        <th></th>
                    </tr>
                        <?php
                            // echo "<tr><th>Student Names</th><th></th></tr>";
                            for($i = 0; $i < sizeof($names); $i++) {
                                $stri = (string)$i;
                                $name = "submit".$stri;
                                // $F = "<td><input type='submit' name='".$name;
                                // $E = "' value='Enter Grades'></td>";
                                $F = "<td><input type='submit' name='".$name;
                                $E = "' value='".$names[$i]."'></td>";
                                echo "<tr>";
                                    // $fName = $fNames[$i];
                                    // $_SESSION["fName"] = $fName;
                                    // echo $fName;
                                    // echo $lName;
                                    // $lName = $lNames[$i];
                                    // $_SESSION["lName"] = $lName;
                                    echo "<td>".$names[$i]."</td>";
                                    echo $F.$E;
                                    // echo "<td><input type='submit' name='".$name."' value='Enter Grades'></td>";
                                echo "</tr>";
                            }
                        ?>
                </table>
                <!-- <input type='submit' name='submit' value='Enter Grades'> -->
            </form>
        </main>
    </body>
</html>