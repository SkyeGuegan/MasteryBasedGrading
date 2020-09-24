<?php
    include_once 'dbh.php';
    require 'sessions-start.php';

    //ALL STUDENT IDs
    $result1 = $db->prepare("SELECT studentID FROM Student GROUP BY lname");
    $result1->execute();
    $studentIDs = $result1->fetchAll(PDO::FETCH_COLUMN, 0);

    //ALL FIRST NAMES
    $result2 = $db->prepare("SELECT fname FROM Student GROUP BY lname");
    $result2->execute();
    $fNames = $result2->fetchAll(PDO::FETCH_COLUMN, 0);

    //ALL LAST NAMES
    $result3 = $db->prepare("SELECT lname FROM Student GROUP BY lname");
    $result3->execute();
    $lNames = $result3->fetchAll(PDO::FETCH_COLUMN, 0);

    //ALL CATEGORY IDs
    $result4 = $db->prepare("SELECT * FROM Category");
    $result4->execute();
    $catIDs = $result4->fetchAll(PDO::FETCH_COLUMN, 0);

    for($i = 0; $i < sizeof($fNames); $i++) {
        $names[$i] = $fNames[$i] . " " . $lNames[$i];
    }

    for($i = 0; $i < sizeof($names); $i++) {
        for($j = 0; $j < sizeof($catIDs); $j++) {
            $result5 = $db->prepare("SELECT count(catID) FROM StudentGrade WHERE studentID=:studentID AND catID=:catID AND (rating='M' OR rating='E')");
            $result5->bindValue(':studentID', $studentIDs[$i]);
            $result5->bindValue(':catID', $catIDs[$j]);
            $result5->execute();
            $countTotals[$j] = $result5->fetch(PDO::FETCH_COLUMN, 0);
        }
        $masteryTotals[$names[$i]] = $countTotals;
    }

    //LC learning target count
    $result6 = $db->prepare("SELECT count(catID) FROM Category WHERE catID LIKE 'LC-%'");
    $result6->execute();
    $lcCount = $result6->fetchAll(PDO::FETCH_COLUMN, 0);

    //LC learning target count
    $result7 = $db->prepare("SELECT count(catID) FROM Category WHERE catID LIKE 'D-%'");
    $result7->execute();
    $dCount = $result7->fetchAll(PDO::FETCH_COLUMN, 0);

    //LC learning target count
    $result8 = $db->prepare("SELECT count(catID) FROM Category WHERE catID LIKE 'DA-%'");
    $result8->execute();
    $daCount = $result8->fetchAll(PDO::FETCH_COLUMN, 0);

    //LC learning target count
    $result9 = $db->prepare("SELECT count(catID) FROM Category WHERE catID LIKE 'I-%'");
    $result9->execute();
    $iCount = $result9->fetchAll(PDO::FETCH_COLUMN, 0);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Display table to show Mastery progress of each student">
    <meta name="author" content="Spencer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasteryCompletionTable</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            height: 50 px;
        }

        .red {
        background-color: #CD5C5C !important;
        }

        .yellow {
        background-color: #E8DC9D !important;
        }

        .green {
        background-color: #7D9A6D !important;
        }


    </style>
</head>
<body>
    <header>
        <h1>Pivot Table</h1>
    </header>
    <?php include 'headers.php'; ?>
    <main>
        <table = id="example" class="display nowrap">
            <tr>
                <th></th>
                <th colspan="<?php echo $lcCount[0]; ?>">Limits and Continuity</th>
                <th colspan="<?php echo $dCount[0]; ?>">Derivatives</th>
                <th colspan="<?php echo $daCount[0]; ?>">Derivate Applications</th>
                <th colspan="<?php echo $iCount[0]; ?>">Integrals</th>
            </tr>
            <?php
                        echo "<tr>";
                            echo "<td><b>Student Name</b></td>";
                            for($i = 0; $i < $lcCount[0]; $i++) {
                                echo "<td>";
                                    echo $i + 1;
                                echo"</td>";
                            }
                            for($i = 0; $i < $dCount[0]; $i++) {
                                echo "<td>";
                                    echo $i + 1;
                                echo "</td>";
                            }
                            for($i = 0; $i < $daCount[0]; $i++) {
                                echo "<td>";
                                    echo $i + 1;
                                echo "</td>";
                            }
                            for($i = 0; $i < $iCount[0]; $i++) {
                                echo "<td>";
                                    echo $i + 1;
                                echo "</td>";
                            }
                        echo "</tr>";
                        for($i = 0; $i < sizeof($names); $i++) {
                            echo "<tr>";
                                echo "<td>".$names[$i]."</td>"; //gets name
                                for($j = 0; $j < sizeof($catIDs); $j++) {
                                    if(isset($masteryTotals[$names[$i]][$j])) {

                                        if($masteryTotals[$names[$i]][$j] == 0) {
                                            echo "<td class=\"red\">";
                                        }

                                        else if($masteryTotals[$names[$i]][$j] == 1) {
                                            echo "<td class=\"yellow\">";
                                        }

                                        else{
                                            echo "<td class=\"green\">";
                                        }
                                        echo $masteryTotals[$names[$i]][$j];
                                        
                                        echo"</td>";
                                    }
                                }
                            echo "</tr>";
                        }
                    ?>
        </table>
    </main>
</body>

</html>
