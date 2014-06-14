<?php
require_once 'Classes\Connection.php';
require_once 'Operazioni\Operazioni.php';
?>
<html>
    <head> <title>Scontrino</title></head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="Css/jquery.mobile-1.4.2.css">
    <link rel="stylesheet" href="Css/bgrTheme.css">
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery.mobile-1.4.2.min.js"></script>
    <body>

        <div align="center">


            <h1> BrodeHouse </h1> <br>
            <b>Via: </b>Garibaldi<br>
            <b>Luogo:</b>Marghera <br>

            <?php
            $a = time();
            $b = date('d M y - H:i:s', $a);
            echo "<b>Ora e data:</b>  " . $b . "<br><br>";
            $tot = 0;
            foreach (Operazioni::getProdottiTavolo($_REQUEST['idTavolo']) as $prodotto) {
                echo($prodotto['quantita'] . " x " . $prodotto['descrizione']);
                echo(' ' . $prodotto['prezzo'] . ' $<br>');
                $tot+=$prodotto['quantita'] * $prodotto['prezzo'];
            }
            echo ('</p>');
//            setlocale(LC_MONETARY, 'it_IT');
//            echo money_format('%.2n', $tot);     queste due righe dovrebbero visualizzare il totale in formato euro decente
            //la funzione floor serve per troncare il numero
            echo('<b>TOTALE: ' . floor(($tot) * 100) * .01 . '$</b>');
            echo "</div>"
            . "<br>";
            echo "<div  align=\"center\">";
            echo "<a align=\"center\" href=\"Operazioni/Pagamento.php?idTavolo=" . $_REQUEST['idTavolo'] . "&importo=" . $tot . "\" class=\"ui-btn ui-btn-inline ui-corner-all ui-shadow\" data-ajax=\"false\"> Paga </a>";
            echo "<br><a align=\"center\" href=\"ordinazione.php?idTavolo=" . $_REQUEST['idTavolo'] . "\" class=\"ui-btn ui-btn-inline ui-corner-all ui-shadow\" data-ajax=\"false\"> Ordinazioni </a>";
            ?>
        </div>

    </body>
</html>
