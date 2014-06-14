<?php

require_once ('../Classes/Connection.php');
require_once ('Operazioni.php');
$dbPDO = Connection::getConnection();

foreach ($_GET as $id => $value) {

    if ($value != "" && $id != "tavoli") {
        foreach (Operazioni::getQuantitaIdIngredienteProdotto($id) as $row) {
            Operazioni::aggiornaQuantitaIngrediente($row['idIngrediente'], $value * $row['quantita']);
            $supp = Operazioni::getQuantitaIngrediente($row['idIngrediente']);
            $supp2 = $supp[0]['quantita'];
            if ($supp2 <= 0) {
                Operazioni::setDisponibilitaIngrediente(0, $row['idIngrediente']);
            }
        }
        Operazioni::addOrdinazioneTavolo($_GET["tavoli"], $id, $value);
        Operazioni::addOrdinazioneGenerale($id, $value, NULL);
    }
}

Connection::closeConnection();
header("Location:../index.php");
?>

