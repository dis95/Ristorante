<?php

require_once '../Classes/Cameriere.php';
require_once '../Classes/Connection.php';
session_start();

if (isset($_SESSION['cameriere']))
    header('location:../index.php');
if ($_POST['user'] != "" && $_POST['password'] != "") {
    $user = $_POST['user'];
    $pw = $_POST['password'];
    //verifica che l'utente esiste nel db e che la password sia corretta
    $dbPDO = Connection::getConnection();
    $dbStm = $dbPDO->prepare("SELECT * "
            . "FROM cameriere "
            . "WHERE cameriere.user = :user AND cameriere.password = :pw");
    $dbStm->bindParam(":user", $user);
    $dbStm->bindParam(":pw", $pw);
    $dbStm->execute();
    if ($result = $dbStm->fetch(PDO::FETCH_BOTH)) {
        // se l utente che ha inserito i dati cè nel database, lo fa entrare nella pagina index e salva in sessione il cameriere che ha loggato
        $_SESSION['cameriere'] = new Cameriere($result['idCameriere'], $result['nome'], $result['cognome'], md5($result['password']), md5($result['user']));
        header("location:../index.php");
    } else { //ritorna alla pagina di login segnalando che i dati immessi sono errati
        header("location:Login.php?err=true");
    }
} else {
    header("location:../index.php");
}


