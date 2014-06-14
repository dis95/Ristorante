<!DOCTYPE html>
<html>
    <?php
    require_once 'Classes\Connection.php';
    require_once 'Operazioni\Operazioni.php';
    session_start();
    if (!isset($_SESSION['amministratore'])) {
        header('Location:Account/Login.php');
        exit();
    }
    ?>
    <head>
        <title>Amministrazione BrodeHouse</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="Css/jquery.mobile-1.4.2.css">
        <link rel="stylesheet" href="Css/bgrTheme.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.mobile-1.4.2.min.js"></script>
    </head>
    <body>
        <?php
        if (isset($_REQUEST['ec'])) {
            Operazioni::eliminaCameriere($_REQUEST['ec']);
        }
        if (isset($_REQUEST['et'])) {
            Operazioni::eliminaTavolo($_REQUEST['et']);
        }
        if (isset($_REQUEST['ep'])) {
            Operazioni::eliminaProdotto($_REQUEST['ep']);
        }
        if (isset($_REQUEST['ei'])) {
            Operazioni::eliminaIngrediente($_REQUEST['ei']);
        }
        if (isset($_REQUEST['en'])){
            Operazioni::eliminaNotifica($_REQUEST['en']);
        }
        if (isset($_REQUEST['eliminaNotifiche'])){
            Operazioni::eliminaNotifiche();
        }
        if (isset($_POST["inserisciC"])) {
            $nome = $_POST["nome"];
            $cognome = $_POST["cognome"];
            $user = $_POST["user"];
            $password = $_POST["password"];
            Operazioni::aggiungiCameriere($nome, $cognome, $user, md5($password));
        }
        if (isset($_POST["inserisciP"])) {
            $descrizione = $_POST["descrizione"];
            $prezzo = $_POST["prezzo"];
            $disponibile = $_POST["disponibile"];
            $codPortata = $_POST["codPortata"];
            Operazioni::aggiungiPiatto($descrizione, $prezzo, $disponibile, $codPortata);
        }
        if (isset($_POST["inserisciT"])) {
            $posti = $_POST["posti"];
            $sala = $_POST["sala"];
            Operazioni::aggiungiTavolo($posti, $sala);
        }

        if (isset($_POST["inserisciI"])) {
            $descrizione = $_POST["descrizione"];
            $quantita = $_POST["quantita"];
            if ($quantita > 1) {
                Operazioni::aggiungiIngrediente($descrizione, $quantita, 1);
            } else {
                Operazioni::aggiungiIngrediente($descrizione, $quantita, 0);
            }
        }

        if (isset($_POST["modificaC"])) {
            $userM = $_POST["userm"];
            $passM = $_POST["passwordm"];
            $id = $_POST["idCa"];
            Operazioni::aggiornaPasswordUser($id, $userM, $passM);
        }

        if (isset($_POST["modificaP"])) {
            $codPortatam = $_POST['codicePortatam'];
            $descM = $_POST["nomem"];
            $prezzoM = $_POST["prezzom"];
            $id = $_POST['idp'];
            Operazioni::aggiornaProdotto($id, $descM, $prezzoM, $codPortatam);
        }


        if (isset($_POST["modificaI"])) {
            $descI = $_POST["descI"];
            $quantI = $_POST["quantI"];
            $id = $_POST['idi'];
            Operazioni::aggiornaDescrizioneQuantitaIngrediente($id, $quantI, $descI);
        }

        if (isset($_POST["modificaT"])) {
            $postiT = $_POST["postiT"];
            $idSalaT = $_POST["idSalaT"];
            $id = $_POST['idT'];
            Operazioni::aggiornaTavolo($id, $postiT, $idSalaT);
        }
        
        if (isset($_POST["inserisciN"])) {
            $testo = $_POST["testoN"];
            Operazioni::aggiungiNotifica($testo);
        }
        
        
        ?>
        <!-- inizio panel per la gestione -->

        <div data-role="panel" id="modificaCameriere" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Modifica cameriere</h1></legend>
                <form method="post" action="#" >
                    <input type="text" name="idCa" placeholder="Inserisci identificativo" required />
                    <input type="text" name="userm" placeholder="Inserisci username" required />
                    <input type="password" name="passwordm" placeholder="Inserisci password" required />
                    <input type="submit" name="modificaC" value="Modifica"/>
                </form>
            </fieldset>
        </div>

        <div data-role="panel" id="modificaTavolo" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Modifica tavolo</h1></legend>
                <form method="post" action="#" id="modificaTavoloForm">
                    <input type="text" name="idT" placeholder="Inserisci identificativo" required />
                    <input type="text" name="postiT" placeholder="Inserisci il numero di posti" required />
                    <input type="text" name="idSalaT" placeholder="Inserisci identificatio della sala" required />
                    <input type="submit" name="modificaT" value="Modifica"/>
                </form>
            </fieldset>
        </div>

        <div data-role="panel" id="modificaProdotto" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Modifica prodotto</h1></legend>
                <form method="post" action="#" id="modificaProdottoForm">
                    <input type="text" name="idp" placeholder="Inserisci identificativo" required />
                    <input type="text" name="nomem" placeholder="Inserisci descrizione" required />
                    <input type="text" name="prezzom" placeholder="Inserisci prezzo" required />
                    <input type="text" name="codicePortatam" placeholder="Inserisci codice della portata" required />
                    <input type="hidden" name="idProdotto" required />
                    <input type="submit" name="modificaP" value="Modifica"/>
                </form>
            </fieldset>
        </div>



        <div data-role="panel" id="modificaIngrediente" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Modifica ingrediente</h1></legend>
                <form method="post" action="#" id="modificaIngredienteForm">
                    <input type="text" name="idi" placeholder="Inserisci identificativo" required />
                    <input type="text" name="descI" placeholder="Inserisci la descizione" required />
                    <input type="text" name="quantI" placeholder="Inserisci la quantita" required />

                    <input type="submit" name="modificaI" value="Modifica"/>
                </form>
            </fieldset>
        </div>

        <div data-role="panel" id="assumiCameriere" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Assumi cameriere</h1></legend>
                <form method="post" action="#" >
                    <input type="text" name="nome" placeholder="Inserisci nome" required />
                    <input type="text" name="cognome" placeholder="Inserisci cognome" required />
                    <input type="text" name="user" placeholder="Inserisci user name" required />
                    <input type="password" name="password" placeholder="Inserisci password" required />
                    <input type="submit" name="inserisciC" value="Inserisci"/>
                </form>
            </fieldset>
        </div>

        <div data-role="panel" id="inserisciTavolo" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Inserisci tavolo</h1></legend>
                <form method="post" action="#" >
                    <input type="text" name="posti" placeholder="Inserisci numero posti" required />
                    <input type="text" name="sala" placeholder="Inserisci stanza" required />
                    <input type="submit" name="inserisciT" value="Inserisci"/>
                </form>
            </fieldset>
        </div>

        <div data-role="panel" id="inserisciPiatto" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Inserisci piatto</h1></legend>
                <form method="post" action="#" >
                    <input type="text" name="descrizione" placeholder="Inserisci descrizione" required />
                    <input type="text" name="prezzo" placeholder="Inserisci prezzo" required />
                    <input type="text" name="disponibile" placeholder="Inserisci disponibilita'" required />
                    <input type="text" name="codPortata" placeholder="Inserisci portata" required />
                    <input type="submit" name="inserisciP" value="Inserisci"/>
                </form>
            </fieldset>
        </div>

        <div data-role="panel" id="inserisciIngrediente" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Inserisci Ingrediente</h1></legend>
                <form method="post" action="#" >
                    <input type="text" name="descrizione" placeholder="Inserisci descrizione" required />
                    <input type="text" name="quantita" placeholder="Inserisci quantità" required />                   
                    <input type="submit" name="inserisciI" value="Inserisci"/>
                </form>
            </fieldset>
        </div>
        
        
        <div data-role="panel" id="inserisciNotifica" data-theme="d">
            <fieldset data-theme="d">
                <legend><h1>Inserisci notifica</h1></legend>
                <form method="post" action="#" >
                    <input type="text" name="testoN" placeholder="Testo notifica" required />
                    <input type="submit" name="inserisciN" value="Inserisci"/>
                </form>
            </fieldset>
        </div>



        <!-- fine panel per la gestione -->

        <div data-role="header" data-position="fixed" data-theme="d" >
            <a href="Account/Logout.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" data-ajax="false">Logout</a>
            <div id="barra" align="center"><h2>Amministrazione</h2></div>
        </div>

        <div data-role="main" class="ui-content" data-theme="d">
            <div data-role="collapsible" data-theme="d">
                <h3>Camerieri</h3>
                <div id="content" data-theme="d">
                    <a href="#assumiCameriere" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" >Assumi cameriere</a>    
                    <a href="#modificaCameriere" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" >Modifica cameriere</a>

                    <table data-role="table" id="tc" data-mode="reflow" class="ui-responsive table-stroke" >
                        <thead>
                            <tr>
                                <th data-priority="persist">idCameriere</th>
                                <th data-priority="1">Cognome</th>
                                <th data-priority="1">Nome</th>
                                <th data-priority="1">Username</th>
                                <th data-priority="1">Password</th>
                                <th data-priority="1"></th>
                                <th data-priority="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach (Operazioni::getListaCamerieri() as $cameriere) {
                                echo "<tr>";
                                echo "<td><b>" . $cameriere["idCameriere"] . "</b></td>";
                                echo "<td>" . $cameriere["Cognome"] . "</td>";
                                echo "<td>" . $cameriere["Nome"] . "</td>";
                                echo "<td>" . $cameriere["user"] . "</td>";
                                echo "<td> criptata </td>";
                                echo "<td> <a href=\"?ec=" . $cameriere["idCameriere"] . "\">Elimina</a> </td>";
                                echo "<td><br> </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>

            <div data-role="collapsible" data-theme="d">
                <h3>Tavoli</h3>
                <div id="content">
                    <a href="#inserisciTavolo" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Inserisci tavolo</a>
                    <a href="#modificaTavolo" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" >Modifica tavolo</a>
                    <table data-role="table" id="tc" data-mode="reflow" class="ui-responsive table-stroke">
                        <thead>
                            <tr>
                                <th data-priority="persist">idTavolo</th>
                                <th data-priority="1">Posti</th>
                                <th data-priority="1">Occupato</th>
                                <th data-priority="1">Sala</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach (Operazioni::getTavoli() as $tavolo) {
                                echo '<tr>';
                                echo '<td><b>' . $tavolo['idTavolo'] . '</b></td>';
                                echo '<td>' . $tavolo['posti'] . '</td>';
                                echo '<td>' . $tavolo['occupato'] . '</td>';
                                echo '<td>' . $tavolo['idSala'] . '</td>';
                                echo "<td> <a href=\"?et=" . $tavolo["idTavolo"] . "\">Elimina</a> </td>";
                                echo '<td><br> </td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div data-role="collapsible" data-theme="d">
                <h3>Prodotti</h3>
                <div data-theme="d">
                    <a href="#inserisciPiatto" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Inserisci prodotto</a>
                    <a href="#modificaProdotto" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" >Modifica prodotto</a>
                    <table data-role="table" id="tp" data-mode="reflow" class="ui-responsive table-stroke">
                        <thead>
                            <tr>
                                <th data-priority="persist">idProdotto</th>
                                <th data-priority="1">Descrizione</th>
                                <th data-priority="1">Prezzo</th>
                                <th data-priority="1">Codice portata</th>
                                <th data-priority="1">Disponibile</th>
                                <th data-priority="1"></th>
                                <th data-priority="1"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach (Operazioni::getProdotti() as $prodotto) {
                                echo '<tr>';
                                echo '<td><b>' . $prodotto['idProdotto'] . '</b></td>';
                                echo '<td>' . $prodotto['descrizione'] . '</td>';
                                echo '<td>' . $prodotto['prezzo'] . '$</td>';
                                echo '<td>' . $prodotto['codPortata'] . '</td>';
                                echo '<td>' . $prodotto['disponibile'] . '</td>';
                                echo "<td> <a href=\"?ep=" . $prodotto["idProdotto"] . "\">Elimina</a> </td>";
                                echo '<td><br> </td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>



            <div data-role="collapsible" data-theme="d">
                <h3>Ingredienti</h3>
                <div data-theme="d">
                    <a href="#inserisciIngrediente" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Inserisci ingrediente</a>
                    <a href="#modificaIngrediente" class="ui-btn ui-btn-inline ui-corner-all ui-shadow" >Modifica ingrediente</a>
                    <table data-role="table" id="tp" data-mode="reflow" class="ui-responsive table-stroke">
                        <thead>
                            <tr>
                                <th data-priority="persist">idIngrediente</th>
                                <th data-priority="1">Descrizione</th>
                                <th data-priority="1">Disponibile</th>
                                <th data-priority="1">Quantita</th>
                                <th data-priority="1"></th>
                                <th data-priority="1"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach (Operazioni::getIngredienti() as $ingrediente) {
                                echo '<tr>';
                                echo '<td><b>' . $ingrediente['idIngrediente'] . '</b></td>';
                                echo '<td>' . $ingrediente['descrizione'] . '</td>';
                                if ($ingrediente['disponibile']) {
                                    echo '<td> Disponibile </td>';
                                } else {
                                    echo '<td> Non disponibile </td>';
                                } //la funzione floor serve per troncare il numero
                                echo '<td>' . floor(($ingrediente['quantita']) * 100) * .01 . '</td>';
                                echo "<td> <a href=\"?ei=" . $ingrediente['idIngrediente'] . "\">Elimina</a> </td>";
                                echo '<td><br> </td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
            
            
            
            <div data-role="collapsible" data-theme="d">
            <h3>Notifiche</h3>
            <div id="content">
                <a href="#inserisciNotifica" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Inserisci notifica</a>
                <a href="?eliminaNotifiche=1" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Elimina notifiche</a>
                <table data-role="table" id="tc" data-mode="reflow" class="ui-responsive table-stroke">
                    <thead>
                        <tr>
                            <th data-priority="persist">idNotifica</th>
                            <th data-priority="1">Testo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach (Operazioni::getNotifiche() as $notifica) {
                            echo '<tr>';
                            echo '<td><b>' . $notifica['idNotifica'] . '</b></td>';
                            echo '<td>' . $notifica['testo'] . '</td>';
                            echo "<td> <a href=\"?en=" . $notifica["idNotifica"] . "\">Elimina</a> </td>";
                            echo '<td><br> </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>


        

    </body>
</html>
