<html>
    <?php
    require_once 'Operazioni\Operazioni.php';
    ?>
    <head>
        <title>BrodeHouse Camerieri</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Css/jquery.mobile-1.4.2.css">
        <link rel="stylesheet" href="Css/bgrTheme.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>
    </head>
    <body>
        <?php
        if (isset($_REQUEST["ido"])) {
            Operazioni::setDisponibilitaTavolo(1, $_REQUEST["ido"]);
        }
        ?>
        <div data-role="header" data-position="fixed" data-theme="c" >
            <a href="index.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" data-ajax="false">Indietro</a>
            <div align="center"><h2>Tavoli</h2></div>
        </div>
        <table data-role="table" id="tc" data-mode="reflow" class="ui-responsive table-stroke" >
            <thead>
                <tr>
                    <th data-priority="persist">idTavolo</th>
                    <th data-priority="1">Posti</th>
                    <th data-priority="1">Sala</th>
                    <th data-priority="1">Occupato</th>
                    <th data-priority="1"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach (Operazioni::getTavoli() as $tavolo) {
                    if (!$tavolo['occupato']) {
                        echo("<tr>");
                        echo "<td> " . $tavolo['idTavolo'] . " </td>";
                        echo "<td> " . $tavolo['idSala'] . " </td>";
                        echo "<td> " . $tavolo['posti'] . " </td>";
                        echo "<td> <a href=\"tavolo.php?ido=" . $tavolo['idTavolo'] . "\" >Occupa</a> </td>";
                        echo("</tr>");
                    }
                }
                ?>
                </body>


                </html>