<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Pagina prodotto</title>
</head>
<body>
<div id="page-div">
        <div id="nav-bar">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href=".">Mercato ortofrutticolo Novoli</a>&nbsp;
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link" aria-current="page" href=".">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catalogo</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="catalogo.php">Catalogo</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="catalogo.php?cat=frutta">Frutta</a></li>
                                <li><a class="dropdown-item" href="catalogo.php?cat=verdura">Verdura</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="catalogo.php?cat=utensili">Utensili</a></li>
                            </ul>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link " href="storia.php" >Storia</a>
                            </li>
                        </ul>
                        <form class="d-flex" action="client-account/switch.php" method="POST">
                            <input class="form-control me-2" type="search" placeholder="Cerca prodotti" aria-label="Cerca" name="prodotto_ricercato">
                            <button class="btn btn-outline-success" type="submit">Cerca</button>&nbsp;&nbsp;&nbsp;
                            <?php //Controllo se è loggato nell'account 
                                session_start(); 
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
            <h4>Info prodotto</h4>
            <br>
            <?php
                require_once "included-files/db-credentials.inc.php";

                //se id non è settato torna a catalogo.php
                if(!isset($_GET["id"]))
                    header("Location: catalogo.php");

                $infoProdotto = array();
                try 
                {
                    //connessione a DB
                    $connection = new PDO("mysql:host=$ES7PHP_HOST;dbname=$ES7PHP_DB", $ES7PHP_USER, $ES7PHP_PASS);
                    
                    foreach($connection->query('SELECT fornitore.nome AS nomeFornitore, prodotto.* FROM prodotto JOIN fornitore ON prodotto.fornitore = fornitore.id WHERE prodotto.id = ' . $_GET["id"]) as $row) 
                        array_push($infoProdotto, array("nome" => $row["nome"], "nomeFornitore" => $row["nomeFornitore"], "prezzo" => $row["prezzo"], "disponibilita" => $row["disponibilita"], "urlImg" => $row["urlImg"], "tipo" => $row["tipo"])); 

                    //sostituisce se stesso con solo il primo elemento
                    $infoProdotto = $infoProdotto[0];

                    //chiusura connessione
                    $connection = null;
                } 
                catch (PDOException $e)
                {
                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();
                }

                if(strcmp($infoProdotto["tipo"], "Frutta") == 0 OR strcmp($infoProdotto["tipo"], "Verdura") == 0) {
                    $um = "Kg"; 
                    $prezzo = "€/Kg";
                    $min = 0.1;
                    $max = $infoProdotto["disponibilita"];
                    $step = 0.1;
                }else {
                    $um = "pezzi";
                    $prezzo = "pezzi";
                    $min = 1;
                    $max = $infoProdotto["disponibilita"];
                    $step = 1;
                }

                echo "<img src=\"" . $infoProdotto["urlImg"] . "\" alt=\"\" style=\"width: 230px; height: 230px; object-fit: cover;\">
                    <br><br>
                    <b>" . $infoProdotto["nome"] . "</b><br>
                    Fornitore: " . $infoProdotto["nomeFornitore"] . "<br>
                    Prezzo: " . $infoProdotto["prezzo"] . "$prezzo <br>
                    Disponibilita: " . $infoProdotto["disponibilita"] . " $um <br><br>
                    <form action='client-account/switch.php' method='POST'>
                        <label for='qta-input'> Inserisci la quantità in <b>$um</b> di prodotto richiesto</label>
                        <input name='qta-input' type='number' placeholder='ex. 10' step='$step' min='$min' max='$max'> &nbsp; 
                        <button class=\"btn btn-primary\" type='submit' name='add-to-cart'>Aggiungi al carrello</button>
                    </form>";

                $_SESSION['infoProdotto'] = $infoProdotto;
            ?>
            </div>
            <br><br>
        </div>
        <footer id="footer" class="pt-4 mt-3 px-5 border-top bg-light" style="flex-shrink: none;">
            <div class="row">
                <div class="col-12 col-md">
                <img class="mb-2 d-inline" src="favicon.ico" alt="icon" width="24" height="24">
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
