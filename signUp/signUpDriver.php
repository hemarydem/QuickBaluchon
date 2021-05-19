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
    <title>homeDriver</title>
</head>
<body id="body">
<?php
    require "../utls/header/header.php";
?>
<div class="col-md-2 col-md-offset-5">
                    <label for="status">profil:</label>
                    <select id="frmSelector">
                        <option value="3">client</option>
                        <option value="1">conducteur</option>
                    </select>
                </div>
    <div class="container" id="app">
        <div class="row ">
            <div class="col-md-4" style="background-color: white" >
                <div class="col-md-2 col-md-offset-5">
                    <label>NOM</label>
                    <input type="text" oninput="checkLen(\'name\',50)" placeholder="name" id="name">
                    <p id="limitname">50/50</p><p id="erroname"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>Prénom</label>
                    <input type="text" oninput="checkLen(\'firstname\',50)"  placeholder="firstname" id="firstname">
                    <p id="limitfirstname">50/50</p><p id="errofirstname"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>passwords</label>
                    <input type="text" oninput="checkLen(\'pssword\',255)" value="azerty" placeholder="password" id="pssword">
                    <p id="limitpssword">255/255</p><p id="erropssword"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>confirmPassword</label>
                    <input type="text" oninput="checkLen(\'confiamtionPword\',255)" value="azerty" placeholder="confirme password" id="confiamtionPword">
                    <p id="limitconfiamtionPword">255/255</p><p id="erroconfiamtionPword"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>adresse</label>
                    <input type="text" oninput="checkLen(\'address\',255)" placeholder="address" id="address">
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
                        <input type="mail" oninput="checkLen(\'mail\',255)"  placeholder="mail" id="mail">
                        <p id="limitmail">255/255</p><p id="erromail"></p>
                    </div>
                </div>
            <div class="col-md-4" style="background-color: white">
                <button onclick="validate()">Sign Up</button>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                        <label>téléphone</label>
                        <input type="text" oninput="checkLen(\'tel\',10)" placeholder="telephon number" id="tel">
                        <p id="limittel">10/10</p><p id="errotel"></p>
                    </div>
                </div>
            </div>
        </div>
        <h1>Vehicule</h1>
        <div class="row ">
            <div class="col-md-4" style="background-color: white" >
                <div class="col-md-2 col-md-offset-5">
                    <label>immatriculation</label>
                    <input type="text" placeholder="imatriculation" oninput="checkLen(\'imatriculation\',50)" id="imatriculation">
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
</body>
<script src="./scipt/scrip.js"></script>
</html>