<!DOCTYPE html>
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
        <div class="card card-box bg-light text-dark w-25 p-3 m-auto mt-5">
            <fieldset>
                <legend>Log-in</legend>
                <br><br>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="input-email" name="input-email" placeholder="name@example.com" required>
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="input-psw" name="input-psw"placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>  
                <br>         
                <div class="text-center">
                    <input type="reset" value="Annulla" class="btn btn-secondary">
                    <input type="submit" value="Accedi" class="btn btn-primary" name="login">
                </div>
                <br>
                <div class="text-center">
                    <label for="text">Se non sei registrato premi <a href="register.php">qui</a></label>
                </div>            
            </fieldset>
        </div>
    </form>
</body>
</html>