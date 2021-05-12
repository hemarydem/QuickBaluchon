<?php
    require "../utls/utls.php";
    checIfsessionStarted();
    checkRightToBeHere(1);
    checkIfconnected();
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
                <h2>Mes voitures</h2>
                <div id="leftcont"></div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div id="centerCont"></div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <h2>Mes fiches de payes</h2>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>immatriculation</label>
                    <input type="text" placeholder="imatriculation" oninput="checkLen('imatriculation',50)" id="imatriculation">
                    <p id="limitimatriculation">50/50</p><p id="erroimatriculation"></p>
                    <label>nombre de colis</label>
                    <input type="text" placeholder="password" id="nbColis">
                    <p id="erronbColis"></p>
                    <label>volumeMax</label>
                    <input type="text" placeholder="volumeMax" id="volumeMax">
                    <p id="errovolumeMax"></p>
                    <label>poids Max</label>
                    <input type="text" placeholder="Max" id="weightMax">
                    <p id="erroweightMax"></p>
                    <div class="container" >
                            <button onclick="validate()">ajouter une voiture</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="background-color: grey">

                <div class="col-md-2 col-md-offset-5">
                        <label for="status">profil:</label>
                        <div id="depoliste">
                        
                        </div>
                </div>
                <button onclick="getDepot(0)">PRECÉDENT</button><button onclick="getDepot(1)">SUIVANT</button>
                <div id="divCheckbox" style="display: none;">0</div>
                <label>livraison dans un rayon ...km</label>
                    <input type="text" placeholder="numéro entier KM" id="zoneMax">
                    <p id="errozoneMax"></p><button onclick="validateForZoneMax()">initialiser la zone d'action</button>
            </div>
            <div class="col-md-4" style="background-color: white">
            </div>
        </div>
        <div class="row ">
            <div class="col-md-2" style="background-color: white">
                
            </div>
            <div class="col-md-6" style="background-color: white" id="COLISLIST">
            <h1>liste des colis à saisir</h1>
            </div>
            <div class="col-md-2" style="background-color: white">
            <h2>liste des colis assigner</h2>
            </div>
        </div>
    <?php
        echo "<div id=\"di\">" . $_SESSION["id_session"] . "</div>";
    ?>
    </div>
</body>
<script src="scriptHomeDriver/homeDriver.js"></script>
</html>