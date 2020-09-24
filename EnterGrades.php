<?php
    include_once 'dbh.php';
    include 'headers.php';
    require 'sessions-start.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="This is the page to enter grades">
        <meta name="author" content="Spencer">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EnterGrades</title>
        <style>
            table {
            border-collapse: collapse;
            width: 100%;
            }
            th, td {
            text-align: left;
            border-bottom: 1px solid #ddd;
            }
        </style>
    </head> 
    <body>
        <header>
            <h1>Enter Grades</h1>
            <p><big>Enter the grades below</big></p>
        </header>
        <?php
            echo "Quiz number: ".$_SESSION["qnum"]."<br>";
            echo "Quiz type: ".$_SESSION["qtype"]."<br>";
            echo "Student name: ".$_SESSION["fname"]." ".$_SESSION["lname"]."<br>";
            $result = $db->prepare("SELECT catID FROM QuizQuestions WHERE MQ = :qnum AND type = :qtype");
            $result->bindValue(':qnum', $_SESSION["qnum"]);
            $result->bindValue(':qtype', $_SESSION["qtype"]);
            $result->execute();
            $i = 1;
            $rows[0] = $result->fetchColumn();;
            while($row = $result->fetchColumn()){
                $rows[$i] = $row;
                $i++;
            }
            $_SESSION["rows"] = $rows;
        ?>
        <main>
            <form method="post" target="viewGrades.php">
                <br>
                <?php
                    echo "<table border='0' style='width:75%'>";
                    echo "<style>th {text-align: left;}</style>";
                    echo "<tr>";
                    echo "<th>Category ID</th>";
                    echo "<th>Rating</th>";
                    echo "<th>Notes</th>";
                    echo "</tr>";
                    $rows = $_SESSION["rows"];
                    for($i = 0; $i < count($rows); $i++){ 
                        echo "<tr>";
                        echo "<td>";
                        echo $rows[$i];
                        echo "</td>";
                        $stri = (string)$i;
                        $name = "rating".$stri;
                        $notes = "notes".$stri;
                        $F = "<input name='".$name;
                        $E = "' type='radio' value='E'>E</input>";
                        $M = "' type='radio' value='M'>M</input>";
                        $P = "' type='radio' value='P'>P</input>";
                        $X = "' type='radio' value='X'>X</input>";
                        $N = "' type='radio' value='N'>N</input>";
                        echo "<td>";
                        echo $F . $E;
                        echo $F . $M;
                        echo $F . $P;
                        echo $F . $X;
                        echo $F . $N;
                        echo "</td>";
                        $T1 = "<textarea rows='2' cols='50' name='".$notes;
                        $T2 = "' placeholder='Any notes can go here' maxlength='200'></textarea>";
                        echo "<td>";
                        echo $T1 . $T2;
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<input type='submit' name='submit' value='submit'>";

                    if(isset($_POST['submit'])) {
                        for($i = 0; $i < count($rows); $i++){
                            $rows[$i];
                            $stri = (string)$i;
                            $name = "rating".$stri;
                            $notes = "notes".$stri;
                            $_SESSION[$name] = $_POST[$name];
                            $_SESSION[$notes] = $_POST[$notes];
                            $result = $db->prepare("INSERT INTO StudentGrade VALUES (:qnum, :row, :studentID, :name, :notes)");
                            $result->bindValue(':qnum', $_SESSION["qnum"]);
                            $result->bindValue(':row', $rows[$i]);
                            $result->bindValue(':studentID', $_SESSION["studentID"]);
                            $result->bindValue(':name', $_SESSION[$name]);
                            $result->bindValue(':notes', $_SESSION[$notes]);
                            $result->execute();
                            // header("Location: http://129.114.104.163/~dbteam/EnterGrades.php");
                        }
                    }
                ?>
            </form>
        </main>
    </body>   
</html>