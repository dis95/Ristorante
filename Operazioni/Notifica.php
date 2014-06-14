<?php

require_once '../Classes/Connection.php';
require_once 'Operazioni.php';
$hint = "";
foreach (Operazioni::getNotifiche() as $row) {
    $hint = $hint . "<br> -  " . $row['testo'];
}
echo $hint;
?>