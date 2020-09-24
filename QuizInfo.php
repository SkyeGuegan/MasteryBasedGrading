<?php
    include_once 'dbh.php';
    require 'sessions-start.php';
    if(isset($_POST['submit']) ) {
        $_SESSION["fname"] = $_POST['fname'];
        $_SESSION["lname"] = $_POST['lname'];
        $_SESSION["qtype"] = $_POST['qtype'];

        $result = $db->prepare("SELECT MQ FROM Quiz WHERE MQ = :qnum AND type = :qtype");
        $result->bindValue(':qnum', $_POST["qnum"]);
        $result->bindValue(':qtype', $_POST["qtype"]);
        $result->execute();
        $_SESSION["qnum"] = $result->fetchColumn();

        if(isset($_SESSION["qnum"]) && !empty($_SESSION["qnum"])){
            $result = $db->prepare("SELECT studentID FROM Student WHERE fname = :fname AND lname = :lname");
            $result->bindValue(':fname', $_SESSION["fname"]);
            $result->bindValue(':lname', $_SESSION["lname"]);
            $result->execute();

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
        <title>QuizInfo</title>
    </head>
    <body>
        <header>
            <h1>Quiz Info</h1>
            <?php include 'headers.php'; ?>
            <p><big>Enter student and quiz information below</big></p>
        </header>
        <main>
        
            <form method="post">
                <p><big>Student first name</big></p>
                <input type="text" name="fname" placeholder="First name" required/>
                <p><big>Student last name</big></p>
                <input type="text" name="lname" placeholder="Last name" required/>
                <p><big>Quiz number</big></p>
                <input type="text" name="qnum" placeholder="Quiz number" required/>
                <p><big>Quiz type (in class or take home)</big></p>
                <input name="qtype" type="radio" value="IC">In class quiz</input>
                <input name="qtype" type="radio" value="TH">Take home quiz</input>
                <br><br>
                <input type="submit" name="submit" value="submit" accesskey="enter">
            </form>
        </main>
    </body>
</html>