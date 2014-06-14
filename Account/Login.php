<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


    <?php
    require_once '../Classes/Cameriere.php';
    require_once '../Classes/Connection.php';
    require_once '../Classes/Amministratore.php';
    session_start();
    if (isset($_SESSION['cameriere'])) {
        header('location:../index.php');
    }
    if (isset($_POST['user'])) {
        if ($_POST['user'] != "" && $_POST['password'] != "") {
            $user = $_POST['user'];
            $pw = $_POST['password'];
            //verifica che l'utente esiste nel db e che la password sia corretta
            $dbPDO = Connection::getConnection();
            $dbStm = $dbPDO->prepare("SELECT * "
                    . "FROM cameriere "
                    . "WHERE cameriere.user = :user AND cameriere.password = :pw AND cameriere.loggato=0;");
            $dbStm->bindParam(":user", $user);
            $dbStm->bindParam(":pw", md5($pw));
            $dbStm->execute();

            if ($result = $dbStm->fetch(PDO::FETCH_BOTH)) {
                // se l utente che ha inserito i dati cè nel database, lo fa entrare nella pagina index e salva in sessione il cameriere che ha loggato
                $_SESSION['cameriere'] = new Cameriere($result['idCameriere'], $result['Nome'], $result['Cognome'], ($result['password']), ($result['user']));
                $dbStm = $dbPDO->prepare("UPDATE cameriere "
                        . " SET cameriere.loggato=1"
                        . " WHERE cameriere.user = :user AND cameriere.password = :pw ;");
                $dbStm->bindParam(":user", $user);
                $dbStm->bindParam(":pw", $pw);
                $dbStm->execute();

                header("location:../index.php");
            } else { //ritorna alla pagina di login segnalando che i dati immessi sono errati
                $dbStm = $dbPDO->prepare("SELECT * "
                        . "FROM amministratore "
                        . "WHERE amministratore.user = :user AND amministratore.password = :pw");
                $dbStm->bindParam(":user", $user);
                $dbStm->bindParam(":pw", $pw);
                $dbStm->execute();
                if ($result = $dbStm->fetch(PDO::FETCH_BOTH)) {
                    $_SESSION['amministratore'] = new Amministratore($result['idAmministratore'], $result['Nome'], $result['Cognome'], ($result['password']), ($result['user']));
                    $dbStm = $dbPDO->prepare("UPDATE amministratore "
                            . " SET amministratore.loggato=1"
                            . " WHERE amministratore.user = :user AND amministratore.password = :pw ;");
                    $dbStm->bindParam(":user", $user);
                    $dbStm->bindParam(":pw", $pw);
                    $dbStm->execute();
                    header("location:../amministrazione.php");
                } else
                    header("location:Login.php?err=true");
            }
        }
    }
    ?>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="../Css/jquery.mobile-1.4.2.css"></link>
            <link rel="stylesheet" href="../Css/bgrTheme.css"></link>
            <script src="../js/jquery-1.10.2.min.js"></script>
            <script src="../js/jquery.mobile-1.4.2.min.js"></script>
            
    </head>
    <body>
        <div data-role="header" data-position="fixed" data-theme="c" >
            <a href="../menu.php" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">Menu'</a>
            <div id="barra" align="center" ><h2>BrodeHouse</h2></div>
        </div>
        <div data-role="main" class="ui-content" data-theme="c" >
            <div align="center">
                <form id="login" action="#" method="post" data-ajax="false">
                    <table>
                        <tr>
                            <td>
                                <label for="user" ><b>User: </b></label>
                            </td>
                            <td>
                                <input type="text" id="user" name="user" required data-theme="c" ></input>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password"><b>Password: </b></label>
                            </td>
                            <td>
                                <input type="password" id="password" name="password" required data-theme="c" ></input>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="LOGIN" data-theme="c" ></input>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                if (isset($_GET['err']) && $_GET['err'] == "true") {
                    echo "<br/><b><font color='red'>Nome utente e/o password errati oppure utente già loggato</b></font>";
                }
                ?>
            </div>
        </div>
    </body>
</html>
