<?php
require_once 'Operazioni\Operazioni.php';
$ingredienti = Operazioni::getIngredientiProdotto($_REQUEST['id']);
?>


<html>
    <head>
        <title><?php
            echo $_REQUEST['descrizione'];
            ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bgrTheme.css">
        <link rel="stylesheet" href="jquery.mobile-1.4.2.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>

    </head>
    <body>
        <div data-role="page" id="mainPage">
            <div data-role="header">
                <a href="menu.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Menu</a>
                <h1><?php
                    echo $_REQUEST['descrizione'];
                    ?></h1>
            </div>
            <div data-role="content" align="center">
                <?php
                echo '<img src="images/' . $_REQUEST['descrizione'] . '.jpg">';
                ?>
                <ul>
                    <?php
                    echo '<th><b>Nome</b>' . $_REQUEST['descrizione'] . '</th><br>';
                    echo '<th><b>Prezzo</b>' . $_REQUEST['prezzo'] . '$</th><br>';

                    foreach ($ingredienti as $row) {

                        echo '<th>' . $row['descrizione'] . '</th><br>';
                    }
                    ?>
                </ul>
            </div>
        </div>

    </body>
</html>

