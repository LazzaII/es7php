<?php
    class Fornitore 
    {
        private $codice;
        private $nome;

        function __construct($codice, $nome)
        {            
            $this->codice = $codice;
            $this->nome = $nome;
        }
    }
?>