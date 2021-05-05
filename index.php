<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a href="http://localhost:8888/"><img id="imgQB" src="img/logo2.png" width="12%"></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">S'inscrire</a>
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
    <h1>COUCOUC</h1>
    <div>
        <input type="button" onclick="getUser()">
    </div>
    <h1>secondbouton</h1>
    <div>
    <input type="button" onclick="getUserone()">
    </div>  
    <div id="containeur">
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="scritp.js"></script>
</html>