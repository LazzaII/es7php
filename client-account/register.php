<!DOCTYPE html>
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
                  
        </fieldset>
    </form>
</body>
</html>