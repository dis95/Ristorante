<html>
    <?php
    require_once 'Classes\Connection.php';
    require_once 'Operazioni\Operazioni.php';
    ?>
    <head>
        <title>Cucina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Css/jquery.mobile-1.4.2.css">
        <link rel="stylesheet" href="Css/bgrTheme.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>
    </head>
    <body>
        <div data-role="header" data-position="fixed" data-theme="c">
            <div align="center"><h2>Cucina</h2></div>
        </div>
        <div data-role="main" class="ui-content" data-theme="c">
            <div class="ui-grid-solo" data-theme="c">
                <div class="ui-block-a" data-theme="c">
                    <?php
                    if (isset($_REQUEST['pronto'])) {
                        Operazioni::setPiattoPronto($_REQUEST['pronto']);
                        Operazioni::aggiungiNotifica("Ordinazione tavolo ".$_REQUEST['pronto']." pronta");
                    }
                    /*foreach (Operazioni::getIdTavoloOrdinazioni() as $el) {
                        echo("<h2>Ordinazione al tavolo: " . $el['idTavolo'] . "</h2><br>");*/
                        foreach (Operazioni::getProdottiTavoloCucina() as $prod) {
                            echo("<h3>Ordinazione al tavolo: ".$prod['idTavolo']."</h3>");
                            echo("<li>" . $prod['quantita'] . " x " . $prod['descrizione']);
                            echo("<br><a href=\"?pronto=" . $prod['idOrdinazione'] . "\" \">Fatto</a></li><br>");
                        }
                        echo("<hr width=\"100%\" size=\"1\" color=\"B8B8B8\">");
                    //}
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>