<?php
    session_start();

    if(!isset($_SESSION["logged-in"])) // In caso ricercasse dalla barra di ricerca lo rimanda in automatico al login
        header("Location: login.php");

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <title>Pagina Account</title>
</head>
<body>
    <div id="page-div">
        <div id="nav-bar">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="../index.php">Mercato ortofrutticolo Novoli</a>&nbsp;
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catalogo</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../catalogo.php">Home</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../catalogo.php?cat=frutta">Frutta</a></li>
                                <li><a class="dropdown-item" href="../catalogo.php?cat=verdura">Verdura</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../catalogo.php?cat=utensili">Utensili</a></li>
                            </ul>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link " href="storia.php">Storia</a>
                            </li>
                        </ul>
                        <form class="d-flex" action="switch.php" method="POST">
                            <input class="form-control me-2" type="search" placeholder="Cerca prodotti" aria-label="Cerca" name="prodotto_ricercato">
                            <button class="btn btn-outline-success" type="submit" name="ricerca">Cerca</button>&nbsp;&nbsp;&nbsp;
                            <?php //Controllo se è loggato nell'account 
                                
                                if(isset($_SESSION["logged-in"])) 
                                    echo '<button class="btn btn-outline-warning" type="submit" name="area-privata">Account</button>';  
                                else
                                    echo '<button class="btn btn-outline-warning" type="submit" name="accesso">Accedi</button>';
                            ?>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <br>
        <div id="main-div">
            <div class="bg-light w-50 m-auto p-4">
                <h3>Area privata</h3>
                <br>
                <div>
                    <div class="d-inline-block" style="width: 49.5%;">
                        <b>Carrello</b>
                        <ul class="list-group">
                            <?php
                                foreach($_SESSION["carrello"] as $index => $prodotto)
                                    echo '<li class="list-group-item">' . $prodotto["qta"] . 'kg di ' . $prodotto["nome"] . ' - Costo: ' . $prodotto["prezzo"] * $prodotto["qta"] .'€</li>';
                            ?>
                        </ul>
                    </div>
                    <div class="d-inline-block" style="width: 49.5%;">
                        <b>Storico ordini</b>
                        <ul class="list-group">
                            <li class="list-group-item">4 kg di carote</li>
                            <li class="list-group-item">5 kg di finocchiacci</li>
                            <li class="list-group-item">1 etto di prosciutto</li>
                            <li class="list-group-item">una fetta di culo</li>
                        </ul>
                    </div>
                </div>
                <?php
                    require_once "../included-files/db-credentials.inc.php";

                   

                    try 
                    {
                        //connessione a DB
                        $connection = new PDO("mysql:host=$ES7PHP_HOST;dbname=$ES7PHP_DB", $ES7PHP_USER, $ES7PHP_PASS);
                        
                        
                        
                        $connection = null;
                    } 
                    catch (PDOException $e)
                    {
                        print "Error!: " . $e->getMessage() . "<br/>";
                        die();
                    }

                ?>
            </div>
        </div>
        <footer id="footer" class="pt-4 mt-3 px-5 border-top bg-light" style="flex-shrink: none;">
            <div class="row">
                <div class="col-12 col-md">
                <img class="mb-2 d-inline" src="../favicon.ico" alt="icon" width="24" height="24">
                <small class="text-muted">M.O.N.</small>
                <small class="d-block mb-3 text-muted">© Anno 0-2021</small>
                </div>
                <div class="col-6 col-md">
                <h5>Contatti</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#">Instagram</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Facebook</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Twitter</a></li>
                </ul>
                </div>
                <div class="col-6 col-md">
                <h5>Risorse</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#">Fornitori</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Soci</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Certificazioni</a></li>
                </ul>
                </div>
                <div class="col-6 col-md">
                <h5>Chi siamo</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#">Team</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Dove siamo</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Privacy</a></li>
                </ul>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>