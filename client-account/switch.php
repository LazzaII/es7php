<?php

    if (isset($_POST["accesso"]))       //Controllo se dalla pagina home (index.php) preme su 'Accedi' per accedere all'account -> vai a pagina di login (login.php)
    {
        header("Location: login.php");
    }
    else if (isset($_POST["ricerca"]))   //Controllo se da dalla pagina home (index.php) ricerca un prodotto dalla barra di ricerca -> apri catalogo.php con la stringa di ricerca come parametro GET 
    {
        header("Location: ../catalogo.php?prodotto_ricercato=" . $_POST["prodotto_ricercato"]);
    }
    else if (isset($_POST["login"]))     //Controllo se dalla pagina home (index.php) preme su 'Account' per vedere le info dell'account -> apri account.php
    {                                       //No aspè non c'ho capito una sega
        try 
        {
            //connessione al db
            $connection = new PDO("mysql:host=$ES7PHP_HOST;dbname=$ES7PHP_DB", $ES7PHP_USER, $ES7PHP_PASS);

            //recupero info dal form
            $email = $_POST["input-email"];
    
            $hashPass = $connection->query('SELECT HASHpassword FROM utenti WHERE email = "' . $email . '";');

            //chiusura connessione
            $connection = null;

        }
        catch (PDOException $ex) 
        {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        //controllo se l'email coincide o no ad un account
        if(count($hashPass) == 0)    //0 righe = nessun match = non esiste un account con questa email
        {
            $output = '<!DOCTYPE html>
                        <html lang="it">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                            <link rel="stylesheet" href="style.css">
                            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
                            <title>E-Commerce Login</title>
                        </head>
                        <body>
                            <form action="login.php" method="POST">
                                <fieldset>
                                    <legend>Log-in</legend>
                        
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="input-email" name="input-email" placeholder="name@example.com" required>
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="input-psw" name="input-psw"placeholder="Password" required>
                                        <label for="floatingPassword">Password</label>
                                    </div>  
                                    <br>         
                                    <div>
                                        <input type="reset" value="Annulla" class="btn btn-secondary">
                                        <input type="submit" value="Accedi" class="btn btn-primary" name="login">
                                    </div>
                                    <div class="alert alert-danger" role="alert" style="width: 50%;">
                                        <strong>Errore: </strong> email errata!
                                    </div>
                                    <br>
                                    <div>
                                        <label for="text">Se non sei registrato premi <a href="register.php">qui</a></label>
                                    </div>            
                                </fieldset>
                            </form>
                        </body>
                        </html>';

            echo $output;
        }
        else        //esiste un account con questa email
        {
            //controllo se la psw coincide
            if(password_verify($_POST["psw"] , $hashPass[0]))
            {
                session_start();
                $_SESSION['logged-in'] = true;

                header("Location: ../index.php");  
            }
            else
            {
                $output = '<!DOCTYPE html>
                        <html lang="it">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                            <link rel="stylesheet" href="style.css">
                            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
                            <title>E-Commerce Login</title>
                        </head>
                        <body>
                            <form action="login.php" method="POST">
                                <fieldset>
                                    <legend>Log-in</legend>
                        
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="input-email" name="input-email" placeholder="name@example.com" required>
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="input-psw" name="input-psw"placeholder="Password" required>
                                        <label for="floatingPassword">Password</label>
                                    </div>  
                                    <br>         
                                    <div>
                                        <input type="reset" value="Annulla" class="btn btn-secondary">
                                        <input type="submit" value="Accedi" class="btn btn-primary" name="login">
                                    </div>
                                    <div class="alert alert-danger" role="alert" style="width: 50%;">
                                        <strong>Errore: </strong> password errata!
                                    </div>
                                    <br>
                                    <div>
                                        <label for="text">Se non sei registrato premi <a href="register.php">qui</a></label>
                                    </div>            
                                </fieldset>
                            </form>
                        </body>
                        </html>';

                echo $output;
            }
        }
    }
    else if (isset($_POST["register"]))         //l'utente vuole registrarsi
    {

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
            if(count($connection->query('SELECT id FROM utenti WHERE email = "' . $email . '";')) == 0)
            {
                $connection->query("INSERT INTO utenti (nome, cognome, email, psw) VALUE ('$nome', '$cognome', '$email', '$psw');");
            }
            else 
            {
                $output = '<!DOCTYPE html>
                            <html lang="it">
                            <head>
                                <meta charset="UTF-8">
                                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                                <link rel="stylesheet" href="style.css">
                                <title>E-Commerce Registrazione</title>
                            </head>
                            <body>
                                <form action="login.php" method="POST">
                                    <fieldset>
                                        <legend>Registrazione</legend>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="input-nome" name="input-nome" placeholder="Mario" required>
                                            <label for="floatingInput">Nome</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="input-cognome" name="input-cognome"  placeholder="Rosso" required>
                                            <label for="floatingInput">Cognome</label>
                                        </div>
                            
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="input-email" name="input-email" placeholder="name@example.com" required>
                                            <label for="floatingInput">Email</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" id="input-psw" name="input-psw" placeholder="Password" required>
                                            <label for="floatingPassword">Password</label>
                                        </div>  
                                        <br>         
                                        <div>
                                            <input type="reset" value="Annulla" class="btn btn-secondary">
                                            <input type="submit" value="Accedi" class="btn btn-primary" name="register">
                                        </div>
                                        <div class="alert alert-danger" role="alert" style="width: 50%;">
                                            <strong>Errore: </strong> l\' è già associata ad un account!
                                        </div>
                                    </fieldset>
                                </form>
                            </body>
                            </html>';
                echo $output;
            }

            //chiusura connessione
            $connection = null;

        } catch (PDOException $ex) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }    
    }
    elseif (isset($_POST["accesso-account"]))
    {

    }
    elseif (isset($_POST["modify-credentials"])) 
    {
        //connessione al db
        $connection = new PDO("mysql:host=$ES7PHP_HOST;dbname=$ES7PHP_DB", $ES7PHP_USER, $ES7PHP_PASS);

        //recupero info dal form
        $email = $_POST["input-email"];
        $psw = password_hash($_POST["input-psw"], PASSWORD_DEFAULT);

        
        
        $connection = null;
    }
?>