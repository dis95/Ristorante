<?php

class Prodotto {

    protected $descrizione;
    protected $codPortata;
    protected $prezzo;
    protected $disponibile;
    protected $idProdotto;

    function __construct($descrizione, $codPortata, $prezzo, $disponibile, $idProdotto) {
        $this->descrizione = $descrizione;
        $this->codPortata = $codPortata;
        $this->prezzo = $prezzo;
        $this->disponibile = $disponibile;
        $this->idProdotto = $idProdotto;
    }

    public function getDescrizione() {
        return $this->descrizione;
    }

    public function getCodicePortata() {
        return $this->codPortata;
    }

    public function getPrezzo() {
        return $this->prezzo;
    }

    public function getDisponibile() {
        return $this->disponibile;
    }

    public function getIdProdotto() {
        return $this->idProdotto;
    }

}
?>

