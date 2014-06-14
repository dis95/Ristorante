<?php

require_once '../Classes/Cameriere.php';
require_once '../Classes/Connection.php';
require_once '../Classes/Amministratore.php';
session_start();
$dbPDO = Connection::getConnection();
if (isset($_SESSION['cameriere'])) {
    $user = $_SESSION['cameriere']->getUser();
    $pw = $_SESSION['cameriere']->getPw();
    $dbStm = $dbPDO->prepare("UPDATE cameriere "
            . " SET cameriere.loggato=0"
            . " WHERE cameriere.user = :user AND cameriere.password = :pw ;");
    $dbStm->bindParam(":user", $user);
    $dbStm->bindParam(":pw", $pw);
} else {
    $user = $_SESSION['amministratore']->getUser();
    $pw = $_SESSION['amministratore']->getPw();
    $dbStm = $dbPDO->prepare("UPDATE amministratore "
            . " SET amministratore.loggato=0"
            . " WHERE amministratore.user = :user AND amministratore.password = :pw ;");
    $dbStm->bindParam(":user", $user);
    $dbStm->bindParam(":pw", $pw);
}
$dbStm->execute();
session_destroy();
header("Location:Login.php");
?>