<?php

require_once ('../Classes/Connection.php');
require_once ('Operazioni.php');
if ($_REQUEST['n'] === 'n') {
    $q = $_REQUEST['n'];
    $hint = "-";
    foreach (Operazioni::getNotifiche() as $row) {
        $hint = $hint . "     " . $row['Testo'];
    }
    echo $hint === "" ? "no suggestion" : $hint;
} else {
    $testo = $_REQUEST['n'];
    Operazioni::inserisciNotifica($testo);
}
?>