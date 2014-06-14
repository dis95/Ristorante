<html>
    <?php
    require_once 'Classes\Connection.php';
    require_once 'Operazioni\Operazioni.php';
    ?>
    <head>
        <title>Ordinazione</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Css/jquery.mobile-1.4.2.css">
        <link rel="stylesheet" href="Css/bgrTheme.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>
    </head>
    <body>
        <div data-role="header" data-position="fixed" data-theme="c" >
            <a href="elenco_ordinazioni.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Indietro</a>
            <?php
            echo("<a href=\"visualizzaScontrino.php?idTavolo=" . $_REQUEST['idTavolo'] . "\" class=\"ui-btn ui-btn-inline ui-corner-all ui-shadow\" >Scontrino</a>");
            echo("<div id=\"barra\" align=\"center\"><h2>Tavolo: " . $_REQUEST['idTavolo'] . "</h2></div>");
            ?>
        </div>

        <div data-role="panel" id="modificaOrdine" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Modifica ordine</h1></legend>
                <form method="post" action="#" >
                    <input type="text" name="idO" placeholder="Inserisci identificativo" required />
                    <input type="text" name="quant" placeholder="Inserisci quantita'" required />
                    <input type="submit" name="modificaO" value="Modifica"/>
                </form>
            </fieldset>
        </div>

        <?php
        if (isset($_POST["modificaO"])) {
            $quantita = $_POST["quant"];
            $id = $_POST['idO'];
            Operazioni::aggiornaOrdinazioneTavolo($id, $quantita);
        }
        ?>
        
        <div data-role="panel" id="aggiungiPiatto" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Aggiungi piatto</h1></legend>
               <?php echo  "<form method=\"post\" action=\"?idTavolo=".$_REQUEST['idTavolo']."\">"; ?>
                    <input type="text" name="descrizioneP" placeholder="Inserisci nome" required />
                    <input type="text" name="quantP" placeholder="Inserisci quantita'" required />
                    <input type="submit" name="aggiungiP" value="Aggiungi"/>
                </form>
            </fieldset>
        </div>

        <?php
        if (isset($_POST["aggiungiP"])) {
            Operazioni::aggiornaOrdinazioneTavolo($_POST['descrizioneP'], $_POST["quantP"], $_REQUEST['idTavolo']);
        }
        ?>



        <br>
        <div data-role="main" class="ui-content">
            <h1>Ordinazione:</h1></p>
        <div class="ui-grid-solo">
            <div class="ui-block-a">
                <?php
                foreach (Operazioni::getProdottiTavolo($_REQUEST['idTavolo']) as $prodotto) {
                    echo("<b>".$prodotto['idOrdinazione'].")    </b>" . $prodotto['quantita'] . " x " . $prodotto['descrizione'] . "<br><br>");
                }
                echo "<a href=\"#modificaOrdine\" class=\"ui-btn ui-btn-inline ui-corner-all ui-shadow\">Modifica</a>";
                echo "<a href=\"#aggiungiPiatto\" class=\"ui-btn ui-btn-inline ui-corner-all ui-shadow\">Aggiungi</a>";
                echo("<hr align=\"left\" size=\"1\" width=\"100%\" color=\"red\" noshade>");
                ?>
            </div>
        </div>
    </div>
</body>
</html>