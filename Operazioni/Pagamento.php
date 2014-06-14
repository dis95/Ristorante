<?php
require_once 'Operazioni.php';
if (isset($_REQUEST['idTavolo'])){
    Operazioni::eliminaOrdinazioniTavolo($_REQUEST['idTavolo']);
    Operazioni::aggiungiScontrino("000000000", $_REQUEST['importo']);
    Operazioni::setDisponibilitaTavolo(0, $_REQUEST['idTavolo']);
    echo "<div align=\"center\">";
    echo "<h1> Pagamento effettuato </h1>";
    
    
    echo"<a href=\"../elenco_ordinazioni.php\" class=\"ui-btn ui-btn-inline ui-corner-all ui-shadow\" data-ajax=\"false\">Indietro</a>";
    echo "</div>";
}


?>

