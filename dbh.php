<?php
    $db = new PDO('sqlite:./myDB/MasteryGrading.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>