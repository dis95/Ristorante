<?php

class Amministratore {

    protected $idAmministratore;
    protected $nome;
    protected $cognome;
    protected $pw;
    protected $user;

    function __construct($idAmministratore, $nome, $cognome, $pw, $user) {
        $this->idAmministratore = $idAmministratore;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->pw = $pw;
        $this->user = $user;

        $dbPDO = Connection::getConnection();
        $stm = $dbPDO->prepare("SELECT *"
                . " FROM amministratore"
                . " WHERE idAmministratore=:id;");
        $stm->bindParam(":id", $idAmministratore);
        $result = $stm->fetch(PDO::FETCH_BOTH);
        Connection::closeConnection();
    }

    public function getIdAmministratore() {
        return $this->idCameriere;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCognome() {
        return $this->cognome;
    }

    public function getPw() {
        return $this->pw;
    }

    public function getUser() {
        return $this->user;
    }

}

?>
