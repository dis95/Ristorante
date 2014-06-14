<?php

require_once ('C:\xampp\htdocs\Ristorante\Classes\Connection.php');

class Operazioni {

    public static function getIngredientiProdotto($idP) {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT ingrediente.descrizione"
                . " FROM prodottoingrediente INNER JOIN ingrediente ON prodottoingrediente.idIngrediente = ingrediente.idIngrediente"
                . " WHERE prodottoingrediente.idProdotto =\"" . $idP . "\";") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getProdotti() {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM prodotto;") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getIngredienti() {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM ingrediente;") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getQuantitaIngrediente($idIngrediente) {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM ingrediente"
                . " WHERE ingrediente.idIngrediente=\"" . $idIngrediente . "\";") as $element) {
            $ret[0] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getNotifiche() {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT idNotifica,testo"
                . " FROM notifica;") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getTavoli() {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM tavolo;") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getIdTavoloOrdinazioni() {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT DISTINCT idTavolo"
                . " FROM ordinazionetavolo;") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getCameriere($idCameriere) {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM cameriere"
                . " WHERE cameriere.idCameriere=\"" . $idCameriere . "\";") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getListaCamerieri() {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM cameriere;") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getDisponibile($tabella, $id) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("SELECT disponibile"
                . " FROM " . $tabella . ""
                . " WHERE " . $tabella . ".id" . $tabella . " = :id;");
        $dbStm->bindParam(":id", $id);
        $dbStm->execute();
        $result = $dbStm->fetch(PDO::FETCH_BOTH);
        Connection::closeConnection();
        return $result['disponibile'];
    }

    public static function getProdottiTavolo($idTavolo) {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM ordinazionetavolo INNER JOIN prodotto ON ordinazionetavolo.idProdotto=prodotto.idProdotto"
                . " WHERE ordinazionetavolo.idTavolo=" . $idTavolo . ""
                . " ORDER BY idOrdinazione") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getIdProdotto($descrizione) {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT idProdotto"
                . " FROM prodotto"
                . " WHERE prodotto.descrizione=" . $descrizione . ";") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getProdottiTavoloCucina() {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM ordinazionetavolo INNER JOIN prodotto ON ordinazionetavolo.idProdotto=prodotto.idProdotto"
                . " WHERE ordinazionetavolo.pronto=0"
                . " ORDER BY data") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function getQuantitaIdIngredienteProdotto($idProdotto) {
        $ret = array();
        $dbPDO = Connection::getConnection();
        foreach ($dbPDO->query("SELECT idIngrediente, quantita"
                . " FROM prodottoingrediente"
                . " WHERE idProdotto = " . $idProdotto . ";") as $element)
            $ret[] = $element;
        Connection::closeConnection();
        return $ret;
    }

    public static function getOrdinazione($idTavolo) {
        $ret = array();
        foreach (Connection::getConnection()->query("SELECT *"
                . " FROM ordinazionetavolo"
                . " WHERE idTavolo=" . $idTavolo . ";") as $element) {
            $ret[] = $element;
        }
        Connection::closeConnection();
        return $ret;
    }

    public static function aggiungiCameriere($nome, $cognome, $user, $password) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("INSERT INTO cameriere (idCameriere, Nome, Cognome, user, password)"
                . " VALUES (NULL, :nome, :cognome, :user, :password);");
        $dbStm->bindParam(":user", $user);
        $dbStm->bindParam(":password", $password);
        $dbStm->bindParam(":nome", $nome);
        $dbStm->bindParam(":cognome", $cognome);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiungiProdottoOrdinazioneTavolo($descrizione, $quantita, $idTavolo) {
        $dbPDO = Connection::getConnection();
        $idProdotto = Operazioni::getIdProdotto($descrizione);
        $dbStm = $dbPDO->prepare("INSERT INTO ordinazionetavolo (idOrdinazioneTavolo, idTavolo, idProdotto, quantita, data, pronto)"
                . " VALUES (NULL, :idTavolo, :idProdotto, :quantita, :data, 1);");
        $dbStm->bindParam(":idTavolo", $idTavolo);
        $dbStm->bindParam(":idProdotto", $idProdotto['idProdotto']);
        $dbStm->bindParam(":quantita", $qauntita);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiungiPiatto($descrizione, $prezzo, $disponibile, $codPortata) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("INSERT INTO prodotto (idProdotto, descrizione, prezzo, disponibile, codPortata)"
                . " VALUES (NULL, :descrizione, :prezzo, :disponibile, :codPortata);");
        $dbStm->bindParam(":descrizione", $descrizione);
        $dbStm->bindParam(":prezzo", $prezzo);
        $dbStm->bindParam(":disponibile", $disponibile);
        $dbStm->bindParam(":codPortata", $codPortata);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiungiTavolo($posti, $idSala) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("INSERT INTO tavolo (idTavolo, posti, occupato, idSala)"
                . " VALUES (NULL, :posti, 0, :idSala);");
        $dbStm->bindParam(":posti", $posti);
        $dbStm->bindParam(":idSala", $idSala);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiungiIngrediente($descrizione, $quantita, $disp) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("INSERT INTO ingrediente (idIngrediente, quantita, disponibile, descrizione)"
                . " VALUES (NULL, :quantita, :disp, :descrizione);");
        $dbStm->bindParam(":quantita", $quantita);
        $dbStm->bindParam(":descrizione", $descrizione);
        $dbStm->bindParam(":disp", $disp);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiungiScontrino($partitaIva, $importo) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("INSERT INTO scontrino (idScontrino, data, importo, partitaIva)"
                . " VALUES (NULL, NULL, :tot, :iva);");
        $dbStm->bindParam(":iva", $partitaIva);
        $dbStm->bindParam(":tot", $importo);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiungiNotifica($testo) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("INSERT INTO notifica (idNotifica, Testo)"
                . " VALUES (NULL, :Testo);");
        $dbStm->bindParam(":Testo", $testo);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function addOrdinazioneTavolo($idTavolo, $idProdotto, $quantita) {

        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("INSERT INTO ordinazionetavolo (idOrdinazione, idTavolo , idProdotto , quantita )"
                . " VALUES (NULL, :idTavolo, :idProdotto , :quantita );");
        $dbStm->bindParam(":idTavolo", $idTavolo);
        $dbStm->bindParam(":idProdotto", $idProdotto);
        $dbStm->bindParam(":quantita", $quantita);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function addOrdinazioneGenerale($idProdotto, $quantita, $data) {

        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("INSERT INTO ordinazionegenerale (idOrdinazioneGenerale, idProdotto , data , quantita )"
                . " VALUES (NULL, :idProdotto , :data , :quantita );");
        $dbStm->bindParam(":data", $data);
        $dbStm->bindParam(":idProdotto", $idProdotto);
        $dbStm->bindParam(":quantita", $quantita);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function eliminaCameriere($idCameriere) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("DELETE FROM cameriere"
                . " WHERE idCameriere=:id;");
        $dbStm->bindParam(":id", $idCameriere);
        $dbStm->execute();
        Connection::closeConnection();
    }
    
    public static function eliminaNotifiche() {
        Connection::getConnection()->query("DELETE FROM notifica;");
        Connection::closeConnection();
    }
    
     public static function eliminaNotifica($idNotifica){
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("DELETE FROM notifica"
                . " WHERE idNotifica=:id;");
        $dbStm->bindParam(":id", $idNotifica);
        $dbStm->execute();
        Connection::closeConnection();
    }
    

    public static function eliminaProdotto($idProdotto) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("DELETE FROM prodotto"
                . " WHERE idProdotto=:id;");
        $dbStm->bindParam(":id", $idProdotto);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function eliminaIngrediente($idIngrediente) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("DELETE FROM ingrediente"
                . " WHERE idIngrediente=:id;");
        $dbStm->bindParam(":id", $idIngrediente);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function eliminaOrdinazioniTavolo($idTavolo) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("DELETE FROM ordinazionetavolo"
                . " WHERE idTavolo=:id;");
        $dbStm->bindParam(":id", $idTavolo);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function eliminaTavolo($idTavolo) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("DELETE FROM tavolo"
                . " WHERE idTavolo=:id;");
        $dbStm->bindParam(":id", $idTavolo);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiornaQuantitaIngrediente($idIngrediente, $quantita) {
        $dbPDO = Connection::getConnection();
        $dbPDO->query("UPDATE ingrediente"
                . " SET ingrediente.quantita = ingrediente.quantita - " . $quantita . ""
                . " WHERE idIngrediente = " . $idIngrediente . ";");
        Connection::closeConnection();
    }

    public static function aggiornaPasswordUser($idCameriere, $user, $pass) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("UPDATE cameriere"
                . " SET user=:user, password=:pass"
                . " WHERE cameriere.idCameriere = :id;");
        $dbStm->bindParam(":id", $idCameriere);
        $dbStm->bindParam(":user", $user);
        $dbStm->bindParam(":pass", $pass);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiornaProdotto($idProdotto, $desc, $prezzo, $codPortata) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("UPDATE prodotto"
                . " SET descrizione=:desc, prezzo=:prezzo, codPortata=:codPortata"
                . " WHERE prodotto.idProdotto = :id;");
        $dbStm->bindParam(":id", $idProdotto);
        $dbStm->bindParam(":desc", $desc);
        $dbStm->bindParam(":prezzo", $prezzo);
        $dbStm->bindParam(":codPortata", $codPortata);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiornaDescrizioneQuantitaIngrediente($idIngrediente, $quant, $desc) {
        $dbPDO = Connection::getConnection();
        $disp = 0;
        if ($quant > 0) {
            $disp = 1;
        }
        $dbStm = $dbPDO->prepare("UPDATE ingrediente"
                . " SET descrizione=:desc, quantita=:quant, disponibile=:disp"
                . " WHERE ingrediente.idIngrediente = :id;");
        $dbStm->bindParam(":id", $idIngrediente);
        $dbStm->bindParam(":desc", $desc);
        $dbStm->bindParam(":quant", $quant);
        $dbStm->bindParam(":disp", $disp);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiornaOrdinazioneTavolo($idOrdinazione, $quantita) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("UPDATE ordinazionetavolo"
                . " SET quantita=:quantita"
                . " WHERE ordinazionetavolo.idOrdinazione = :id;");
        $dbStm->bindParam(":id", $idOrdinazione);
        $dbStm->bindParam(":quantita", $quantita);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiornaStatoTavolo($idTavolo, $occupato) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("UPDATE tavolo"
                . " SET occupato=:occupato"
                . " WHERE idtavolo = :id;");
        $dbStm->bindParam(":id", $idTavolo);
        $dbStm->bindParam(":occupato", $occupato);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function aggiornaTavolo($idTavolo, $posti, $idSala) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("UPDATE tavolo"
                . " SET posti=:posti, idSala=:idSala"
                . " WHERE idtavolo = :id;");
        $dbStm->bindParam(":id", $idTavolo);
        $dbStm->bindParam(":posti", $posti);
        $dbStm->bindParam(":idSala", $idSala);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function setDisponibilitaTavolo($disponibilita, $id) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("UPDATE tavolo "
                . " SET tavolo.occupato=:disponibilita"
                . " WHERE  tavolo.idTavolo= :id;");
        $dbStm->bindParam(":id", $id);
        $dbStm->bindParam(":disponibilita", $disponibilita);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function setDisponibilitaIngrediente($disponibilita, $id) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("UPDATE ingrediente "
                . " SET ingrediente.disponibile=:disponibilita"
                . " WHERE  ingrediente.idIngrediente= :id;");
        $dbStm->bindParam(":id", $id);
        $dbStm->bindParam(":disponibilita", $disponibilita);
        $dbStm->execute();
        Connection::closeConnection();
    }

    public static function setPiattoPronto($idOrdinazione) {
        $dbPDO = Connection::getConnection();
        $dbStm = $dbPDO->prepare("UPDATE ordinazionetavolo "
                . " SET ordinazionetavolo.pronto=1"
                . " WHERE  ordinazionetavolo.idOrdinazione= :idOrdinazione;");
        $dbStm->bindParam(":idOrdinazione", $idOrdinazione);
        $dbStm->execute();
        Connection::closeConnection();
    }

}
?>

