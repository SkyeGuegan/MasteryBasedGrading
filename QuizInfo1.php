<?php
    include_once 'dbh.php';
    // include 'header.php';
    session_start();
?>
<?php
    if(isset($_POST['submit'])) {
        $_SESSION["fname"] = $_POST['fname'];
        $_SESSION["lname"] = $_POST['lname'];
        $_SESSION["qnum"] = $_POST['qnum'];
        $_SESSION["qtype"] = $_POST['qtype'];
        echo $_POST['qtype'];
        $result = $db->prepare("SELECT studentID FROM Student WHERE fname = :fname AND lname = :lname");
        $result->bindValue(':fname', $_SESSION["fname"]);
        $result->bindValue(':lname', $_SESSION["lname"]);
        $result->execute();
        $_SESSION["studentID"] = $result->fetchColumn();
        // echo $_SESSION["studentID"];
        // header("Location: http://129.114.104.163/~dbteam/EnterGrades.php");
    }
?>