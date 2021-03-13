<?php
    class Prodotto 
    {
        private $nome;
        private $codice;
        private $fornitore;
        private $prezzo;
        private $disponibilita;      
        private $tipo;
        private $urlImmagine;

        function __construct($nome, $codice, $fornitore, $prezzo, $disponibilita,  $tipo, $urlImmagine)
        {
            $this->nome = $nome;
            $this->codice = $codice;
            $this->fornitore = $fornitore;
            $this->prezzo = $prezzo;
            $this->disponibilita = $disponibilita;           
            $this->tipo = $tipo;
            $this->urlImmagine = $urlImmagine;
        }   
    }
?>