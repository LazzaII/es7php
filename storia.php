<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Storia del M.O.N.</title>
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
                                <li><a class="dropdown-item" href="catalogo.php">Home</a></li>
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
                                    echo '<button class="btn btn-outline-warning" type="submit" name="login>Account</button>';  
                                else
                                    echo '<button class="btn btn-outline-warning" type="submit" name="accesso">Accedi</button>';
                            ?>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
        <br><br>
        <div id="main-div">
            <div class="bg-light w-50 m-auto p-4">
                <h3>Storia</h3>
                <p>
                    Le sue origini risalgono agli anni venti del XX secolo, quando l'amministrazione comunale si rese conto dell'insufficienza 
                    del vecchio mercato di Sant'Ambrogio, peraltro impossibile da ampliare perché in pieno centro cittadino.
                </p>
                <p>
                    Dopo alcuni anni di discussioni e dibattiti sul tema, il comune decise di costruire la nuova struttura solo nel 1937, in un'area periferica
                    (quella di Novoli), annessa al comune di Firenze solo pochi anni prima (fino al 1928 aveva fatto parte di quello di Sesto Fiorentino) e ben servita sia dalla ferrovia che 
                    dalla allora nuovissima autostrada Firenze-Mare. I lavori iniziarono nella primavera del 1939 ma furono rallentati per l'ingresso dell'Italia nella seconda guerra mondiale (1940) 
                    e definitivamente sospesi nel febbraio 1944.
                </p>
                <p>
                    Durante la guerra e subito dopo i pochi edifici che erano stati costruiti furono occupati dagli sfollati e, passata l'emergenza, il comune di Firenze, 
                    all'epoca amministrato da Giorgio La Pira, decise di riprendere la costruzione della struttura ma con un nuovo progetto più ampio (1955-1958), opera dell'ingegnere Giulio Cesare Lensi Orlandi,
                    autore anche del progetto dell'epoca fascista, in quanto tecnico comunale. All'inizio del 1956 i lavori del primo lotto vengono affidati all'impresa di Flavio Callisto Pontello. 
                    Il Mercato ortofrutticolo fu inaugurato il 18 settembre 1960 alla presenza dell'allora Presidente del Consiglio Amintore Fanfani.
                </p>
                <div>
                    <div class="d-inline-block">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1e/Tettoia_dei_Produttori_-_Mercato_Ortofrutticolo_di_Novoli.jpg/310px-Tettoia_dei_Produttori_-_Mercato_Ortofrutticolo_di_Novoli.jpg" alt="tettoia dei produttori">
                        <p class="text-muted">Tettoia dei produttori</p>
                    </div>&nbsp;&nbsp;
                    <div class="d-inline-block">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Pensilina_di_carico_-_Mercato_Ortofrutticolo_di_Novoli.jpg/310px-Pensilina_di_carico_-_Mercato_Ortofrutticolo_di_Novoli.jpg" alt="tettoia dei produttori">
                        <p class="text-muted">Pensilina di carico (oggi distrutta)</p>
                    </div>
                </div>
                <p>
                    Negli anni immediatamente successivi al 1980, l'importanza del mercato incrementò con l'istituzione del centro alimentare polivalente "Mercafir".
                </p>
            </div>
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