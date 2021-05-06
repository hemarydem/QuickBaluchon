<?php
    require "../utls/utls.php";
    checIfsessionStarted();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img id="imgQB" src="logo2.png" width="12%">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="signIn/signIn.php">S'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Se connecter</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <!-- animation webgl -->
        <img src="logo2.png">
    </main>
    <footer>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">A Propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nous contacter</a>
                    </li>
                </ul>
            </div>
        </nav>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</html>