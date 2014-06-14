<?php
require_once 'Operazioni/Operazioni.php';
require_once 'Classes\Prodotto.php';

foreach (Operazioni::getProdotti() as $row) {
    $app = new Prodotto($row['descrizione'], $row['codPortata'], $row['prezzo'], $row['disponibile'], $row['idProdotto']);
    $lst[] = $app;
}
?>

<html>
    <head>
        <title>Menu' BrodeHouse</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Css/jquery.mobile-1.4.2.css">
        <link rel="stylesheet" href="Css/bgrTheme.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>
    </head>
    <body>
        <div data-role="page" id="antipasti" data-theme="a">
            <div data-role="panel" id="apanelNotifiche" data-theme="a"> 
                <h2>Portate</h2>    
                <ul data-role="listview">
                    <li><a href="#primi">Primi</a></li>
                    <li><a href="#secondi">Secondi</a></li>
                    <li><a href="#contorni">Contorni</a></li>
                    <li><a href="#aperitivi">Aperitivi</a></li>
                    <li><a href="#bibite">Bibite</a></li>
                </ul>
            </div> 

            <div data-role="header" data-position="fixed"  >
                <a href="#apanelNotifiche" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Portate</a>
				<a href="index.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" data-ajax="false">Cameriere</a>
                <div  align="center"><h2>Antipasti</h2></div>
            </div>

            <div data-role="main" class="ui-content" data-theme="a">
                <ul data-role="listview">
                    <?php
                    foreach ($lst as $element) {
                        if ($element->getCodicePortata() == 1 && $element->getDisponibile()) {
                            echo "<li><a href=\"piatto.php?id=" . $element->getIdProdotto() . ""
                            . "&descrizione=" . $element->getDescrizione() . ""
                            . "&prezzo=" . $element->getPrezzo() . "\" "
                            . ">" . $element->getDescrizione() . "</a></li>";
                        }
                    }
                    ?>
                </ul>
                <br>

            </div> 
        </div>

        <div data-role="page" id="primi" data-theme="a">
            <div data-role="panel" id="ppanelNotifiche" data-theme="a"> 
                <h2>Portate</h2>    
                <ul data-role="listview">
                    <li><a href="#antipasti">Antipasti</a></li>
                    <li><a href="#secondi">Secondi</a></li>
                    <li><a href="#contorni">Contorni</a></li>
                    <li><a href="#aperitivi">Aperitivi</a></li>
                    <li><a href="#bibite">Bibite</a></li>
                </ul>
            </div> 

            <div data-role="header" data-position="fixed"  >
                <a href="#ppanelNotifiche" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Portate</a>
				<a href="index.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" data-ajax="false">Cameriere</a>
                <div  align="center"><h2>Primi</h2></div>
            </div>

            <div data-role="main" class="ui-content" data-theme="a">
                <ul data-role="listview">
                    <?php
                    foreach ($lst as $element) {
                        if ($element->getCodicePortata() == 2 && $element->getDisponibile()) {
                            echo "<li><a href=\"piatto.php?id=" . $element->getIdProdotto() . ""
                            . "&descrizione=" . $element->getDescrizione() . ""
                            . "&prezzo=" . $element->getPrezzo() . "\" "
                            . ">" . $element->getDescrizione() . "</a></li>";
                        }
                    }
                    ?>
                </ul>
                <br>

            </div> 
        </div>
        
        <!-- Primi -->
        <div data-role="page" id="secondi" data-theme="a">
            <div data-role="panel" id="spanelNotifiche" data-theme="a"> 
                <h2>Portate</h2>    
                <ul data-role="listview">
                    <li><a href="#antipasti">Antipasti</a></li>
                    <li><a href="#primi">Primi</a></li>
                    <li><a href="#contorni">Contorni</a></li>
                    <li><a href="#aperitivi">Aperitivi</a></li>
                    <li><a href="#bibite">Bibite</a></li>
                </ul>
            </div> 

            <div data-role="header" data-position="fixed" id="testa_p" >
                <a href="#spanelNotifiche" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Portate</a>
				<a href="index.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" data-ajax="false">Cameriere</a>
                <div id="barra_a" align="center"><h2>Secondi</h2></div>
            </div>
            <div data-role="main" class="ui-content" data-theme="a">
                <ul data-role="listview">
                    <?php
                    foreach ($lst as $element) {
                        if ($element->getCodicePortata() == 3 && $element->getDisponibile()) {
                            echo "<li><a href=\"piatto.php?id=" . $element->getIdProdotto() . ""
                            . "&descrizione=" . $element->getDescrizione() . ""
                            . "&prezzo=" . $element->getPrezzo() . "\" "
                            . ">" . $element->getDescrizione() . "</a></li>";
                        }
                    }
                    ?>
                </ul>

            </div>
        </div>

        <!-- Antipasti -->
        <div data-role="page" id="contorni" data-theme="a">
            <div data-role="panel" id="cpanelNotifiche" data-theme="a"> 
                <h2>Portate</h2>    
                <ul data-role="listview">
                    <li><a href="#antipasti">Antipasti</a></li>
                    <li><a href="#primi">Primi</a></li>
                    <li><a href="#secondi">Secondi</a></li>
                    <li><a href="#aperitivi">Aperitivi</a></li>
                    <li><a href="#bibite">Bibite</a></li>
                </ul>
            </div> 

            <div data-role="header" data-position="fixed" id="testa_a" >
                <a href="#cpanelNotifiche" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Portate</a>
				<a href="index.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" data-ajax="false">Cameriere</a>
                <div id="barra_a" align="center"><h2>Contorni</h2></div>
            </div>

            <div data-role="main" class="ui-content" data-theme="a">
                <ul data-role="listview">
                    <?php
                    foreach ($lst as $element) {
                        if ($element->getCodicePortata() == 4 && $element->getDisponibile()) {
                            echo "<li><a href=\"piatto.php?id=" . $element->getIdProdotto() . ""
                            . "&descrizione=" . $element->getDescrizione() . ""
                            . "&prezzo=" . $element->getPrezzo() . "\" "
                            . ">" . $element->getDescrizione() . "</a></li>";
                        }
                    }
                    ?>
                </ul>

            </div>
        </div>

        <!-- Secondi -->
        <div data-role="page" id="dolci" data-theme="a">
            <div data-role="panel" id="dpanelNotifiche" data-theme="a"> 
                <h2>Portate</h2>    
                <ul data-role="listview">
                    <li><a href="#antipasti">Antipasti</a></li>
                    <li><a href="#primi">Primi</a></li>
                    <li><a href="#secondi">Secondi</a></li>
                    <li><a href="#aperitivi">Aperitivi</a></li>
                    <li><a href="#bibite">Bibite</a></li>
                </ul>
            </div> 

            <div data-role="header" data-position="fixed" id="testa_s" >
                <a href="#dpanelNotifiche" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Portate</a>
				<a href="index.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" data-ajax="false">Cameriere</a>
                <div id="barra_a" align="center"><h2>Dolci</h2></div>
            </div>

            <div data-role="main" class="ui-content" data-theme="a">
                <ul data-role="listview">
                    <?php
                    foreach ($lst as $element) {
                        if ($element->getCodicePortata() == 5 && $element->getDisponibile()) {
                            echo "<li><a href=\"piatto.php?id=" . $element->getIdProdotto() . ""
                            . "&descrizione=" . $element->getDescrizione() . ""
                            . "&prezzo=" . $element->getPrezzo() . "\" "
                            . ">" . $element->getDescrizione() . "</a></li>";
                        }
                    }
                    ?>
                </ul>

            </div>
        </div>


    </body>
</html>