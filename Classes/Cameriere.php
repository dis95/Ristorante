<?php

class Cameriere {

    protected $idCameriere;
    protected $nome;
    protected $cognome;
    protected $pw;
    protected $user;

    function __construct($idCameriere, $nome, $cognome, $pw, $user) {
        $this->idCameriere = $idCameriere;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->pw = $pw;
        $this->user = $user;

        $dbPDO = Connection::getConnection();
        $stm = $dbPDO->prepare("SELECT *"
                . " FROM cameriere"
                . " WHERE idCameriere=:id;");
        $stm->bindParam(":id", $idCameriere);
        $result = $stm->fetch(PDO::FETCH_BOTH);
        Connection::closeConnection();
    }

    public function getIdCameriere() {
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
