<?php
    require "utls/utls.php";
    checIfsessionStarted();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./css/index.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a href="http://quickbaluchonservice.site/QuickBaluchon/#"><img id="imgQB" src="img/logo2.png" width="12%"></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav mr-auto">
                        
                        <li class="nav-item dropdown">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    s'inscrire
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="./signUp/signUpDriver.php">formulair conducteur</a>
                                    <a class="dropdown-item" href="./signUp/signUpClient.php">formulair client</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./signIn/signIn.php">Se connecter</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    <div class="dropdown-menu">
        <form class="px-4 py-3">
            <div class="form-group">
                <label for="exampleDropdownFormEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
            </div>
            <div class="form-group">
                <label for="exampleDropdownFormPassword1">Password</label>
                <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="dropdownCheck">
                <label class="form-check-label" for="dropdownCheck">
                    Remember me
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">New around here? Sign up</a>
        <a class="dropdown-item" href="#">Forgot password?</a>
    </div>


    <div id="wrapper">
    </div>
    <img src="./img/colisImg.jpeg" class="img-fluid" alt="Responsive image">

    <!--<div class="wrapper">
        <img src="./img/colisImg.jpeg" class="img-responsive" alt="Responsive image">
        
    </div>-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<script src="scritp.js"></script>
</html>