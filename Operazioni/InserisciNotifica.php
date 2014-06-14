<?php

require_once '../Classes/Connection.php';
require_once 'Operazioni.php';
if (isset($_SESSION['testoNotifica'])) {
    Operazioni::inserisciNotifica($_SESSION['testoNotifica']);
}
?>