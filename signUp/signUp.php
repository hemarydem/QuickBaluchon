<?php
    require "../utls/utls.php";
    checIfsessionStarted();
    checkRightToBeHere(3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <title>homeDriver</title>
</head>
<body id="body">
<?php
    require "../utls/header/header.php";
?>
    <div class="container" id="app">
        <div class="row ">
            <div class="col-md-4" style="background-color: white" >
                <div class="col-md-2 col-md-offset-5">
                    <label>NOM</label>
                    <input type="text" placeholder="password" id="name">
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>Prénom</label>
                    <input type="text" placeholder="password" id="firstname">
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>passwords</label>
                    <input type="text" placeholder="password" id="pssword">
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>confirmPassword</label>
                    <input type="text" placeholder="password" id="confiamtionPword">
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>adresse</label>
                    <input type="text" placeholder="password" id="address">
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>numSiret</label>
                    <input type="text" placeholder="password" id="numSiret">
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                        <label>téléphone</label>
                        <input type="text" placeholder="password" id="tel">
                    </div>
                </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label for="status">profil:</label>
                    <select id="statut">
                        <option value="1">client</option>
                        <option value="3">conducteur</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
            </div>
        </div>
    </div>
</body>
<script src="/scipt/scrip.js`"></script>
</html>