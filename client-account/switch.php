<?php

    if (isset($_POST["accesso"]))       //Controllo se dalla pagina home (index.php) preme su 'Accedi' per accedere all'account -> vai a pagina di login (login.php)
    {
        header("Location: login.php");
    }
    elseif (isset($_POST["ricerca"]))   //Controllo se da dalla pagina home (index.php) ricerca un prodotto dalla barra di ricerca -> apri catalogo.php con la stringa di ricerca come parametro GET 
    {
        header("Location: ../catalogo.php?prodotto_ricercato=" . $_POST["prodotto_ricercato"]);
    }
    elseif (isset($_POST["login"]))     //Controllo se dalla pagina home (index.php) preme su 'Account' per vedere le info dell'account -> apri account.php
    {           
        session_start();
        require_once("../included-files/db-credentials.inc.php");

        try 
        {
            //connessione al db
            $connection = new PDO("mysql:host=$ES7PHP_HOST;dbname=$ES7PHP_DB", $ES7PHP_USER, $ES7PHP_PASS);

            //recupero info dal form
            $email = $_POST["input-email"];
    
            $hashPass = array();
            foreach ($connection->query('SELECT HASHpassword FROM utenti WHERE email = LOWER("' . $email . '");') as $index => $row)
                $hashPass = $row;

            //chiusura connessione
            $connection = null;

        }
        catch (PDOException $ex) 
        {
            print "Error!: " . $ex->getMessage() . "<br/>";
            die();
        }

        //controllo se l'email coincide o no ad un account
        if(count($hashPass) == 0)    //0 righe = nessun match = non esiste un account con questa email
        {
            $_SESSION["error-login"] = true;
            header("Location: login.php");
        }
        else        //esiste un account con questa email
        {
            //controllo se la psw coincide
            if(password_verify($_POST["input-psw"] , $hashPass[0]))
            {
                session_start();
                $_SESSION['logged-in'] = true;

                header("Location: ../index.php");  
            }
            else
            {
                $_SESSION["error-login"] = true;
                header("Location: login.php");
            }
        }
    }
    elseif (isset($_POST["register"]))         //l'utente vuole registrarsi
    {
        session_start();
        require_once("../included-files/db-credentials.inc.php");

        try 
        {    
            //connessione al db
            $connection = new PDO("mysql:host=$ES7PHP_HOST;dbname=$ES7PHP_DB", $ES7PHP_USER, $ES7PHP_PASS);

            //recupero info dal form
            $nome = $_POST["input-nome"];
            $cognome = $_POST["input-cognome"];
            $email = $_POST["input-email"];
            $psw = password_hash($_POST["input-psw"], PASSWORD_DEFAULT);
        
            //controllo se l'email esiste già -> no = inserisci le info del nuovo utente, sì = errore
            if($connection->query('SELECT id FROM utenti WHERE email = "' . $email . '";')->rowCount() == 0)
            {
                $connection->query("INSERT INTO utenti (nome, cognome, email, HASHpassword) VALUE ('$nome', '$cognome', LOWER('$email'), '$psw');");
                header("Location: login.php");
            }
            else 
            {
                $_SESSION["error-register"] = true;
                header("Location: register.php");
            }

            //chiusura connessione
            $connection = null;

        } catch (PDOException $ex) {
            print "Error!: " . $ex->getMessage() . "<br/>";
            die();
        }    
    }
    elseif (isset($_POST["area-privata"]))  //ha premuto il bottone per visitare la pagina di account, carrello e ordini 
    {
        header("Location: account.php");
    }elseif (isset($_POST["add-to-cart"])) {
        session_start();

        $qta = $_POST["qta-input"];
        $_SESSION['carrello'] = array();
        array_push($_SESSION['carrello'], array("nome" => $_SESSION["infoProdotto"]["nome"], "prezzo" => $_SESSION["infoProdotto"]["prezzo"], "qta" => $qta));

       /*  try {
            $connection->query('UPDATE ');
        }catch(PDOException $ex) {
            print "Error!: " . $ex->getMessage() . "<br/>";
            die();
        }
        
        $connection = null; */

        header("Location ../catalogo.php");
    }
?>