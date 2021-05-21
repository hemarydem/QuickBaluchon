<?php
    require "../utls/utls.php";
    checIfsessionStarted();
    checkRightToBeHere(3);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
                    <input type="text" oninput="checkLen('name',50)" placeholder="name" id="name">
                    <p id="limitname">50/50</p><p id="erroname"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>Prénom</label>
                    <input type="text" oninput="checkLen('firstname',50)"  placeholder="firstname" id="firstname">
                    <p id="limitfirstname">50/50</p><p id="errofirstname"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>passwords</label>
                    <input type="text" oninput="checkLen('pssword',255)" value="azerty" placeholder="password" id="pssword">
                    <p id="limitpssword">255/255</p><p id="erropssword"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>confirmPassword</label>
                    <input type="text" oninput="checkLen('confiamtionPword',255)" value="azerty" placeholder="confirme password" id="confiamtionPword">
                    <p id="limitconfiamtionPword">255/255</p><p id="erroconfiamtionPword"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>adresse</label>
                    <input type="text" oninput="checkLen('address',255)" placeholder="address" id="address">
                    <p id="limitaddress">255/255</p><p id="erroaddress"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>permis</label>
                    <input type="file" accept="image/*,.pdf" id="driverLicence">
                    <p id="errodriverLicence"></p>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>mail</label>
                    <input type="mail" oninput="checkLen('mail',255)"  placeholder="mail" id="mail">
                    <p id="limitmail">255/255</p><p id="erromail"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <button onclick="validate()">Sign Up</button>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>téléphone</label>
                    <input type="text" oninput="checkLen('tel',10)" placeholder="telephon number" id="tel">
                    <p id="limittel">10/10</p><p id="errotel"></p>
                </div>
            </div>
        </div>
        <h1>Vehicule</h1>
        <div class="row ">
            <div class="col-md-4" style="background-color: white" >
                <div class="col-md-2 col-md-offset-5">
                    <label>immatriculation</label>
                    <input type="text" placeholder="imatriculation" oninput="checkLen('imatriculation',50)" id="imatriculation">
                    <p id="limitimatriculation">50/50</p><p id="erroimatriculation"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>nombre de colis</label>
                    <input type="text" placeholder="password" id="nbColis">
                    <p id="erronbColis"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>volumeMax</label>
                    <input type="text" placeholder="volumeMax" id="volumeMax">
                    <p id="errovolumeMax"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>poids Max</label>
                    <input type="text" placeholder="Max" id="weightMax">
                    <p id="erroweightMax"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<script src="./scipt/driverScript.js"></script>
</html>