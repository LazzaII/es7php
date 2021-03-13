<?php

    if (isset($_POST["accesso"])) header("Location: login.php"); //Controllo se dalla pagina home (index.php) preme su 'Accedi' per accedere all'account
    elseif (isset($_POST["ricerca"])) //Controllo se da dalla pagina home (index.php) ricerca un prodotto dalla barra di ricerca
    {
        header("Location: ricerca.php");
    } 
    elseif (isset($_POST["login"])) //LOGIN
    {
        try {
            
            //connessione al db
            $connection = new PDO("mysql:host=$ES7PHP_HOST;dbname=$ES7PHP_DB", $ES7PHP_USER, $ES7PHP_PASS);

            //recupero info dal form
            $email = $_POST["input-email"];
    
            $ris = $connection->query("SELECT HASHpassword FROM utenti WHERE email = $email");

            //chiusura connessione
            $connection = null;

        } catch (PDOException $ex) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        //controllo se l'email coincide ad un account
        if(count($ris) == 0)
        {
            //dire che l'email è sbagliata
        }
        else
        {
            //controllo se la psw coincide
            if(password_verify($_POST["psw"] ,$ris[0]))
            {
                session_start();
                $_SESSION['logged-in'] = true;
            }
            else
            {
                //dire che la psw è sbagliata
            }
        }
    }
    elseif (isset($_POST["register"])) //REGISTRAZIONE
    {

        try {
            
            //connessione al db
            $connection = new PDO("mysql:host=$ES7PHP_HOST;dbname=$ES7PHP_DB", $ES7PHP_USER, $ES7PHP_PASS);

            //recupero info dal form
            $nome = $_POST["input-nome"];
            $cognome = $_POST["input-cognome"];
            $email = $_POST["input-email"];
            $psw = password_hash($_POST["input-psw"], PASSWORD_DEFAULT);
        
            //controllo se l'email esiste già
            if(count($connection->query("SELECT id FROM utenti WHERE email = $email")) == 0)
            {
                $connection->query("INSERT INTO utenti (nome, cognome, email, psw) VALUE ($nome, $cognome, $email, $psw)");
            }
            else 
            {
                // Dire che l'email è già presente
            }

            //chiusura connessione
            $connection = null;

        } catch (PDOException $ex) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }    
    }

?>