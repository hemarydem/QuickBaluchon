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
    <title>homeDriver</title>
</head>
<body id="body">
<?php
    require "../utls/header/header.php";
?>
    <div class="container" id="app">
        <div class="row">
            <div class="col">
                <h1>Mes voitures</h1>
            </div>
            <div class="col">
                <h1 id="titleCarInformation" >voitures en service</h1>
                <p style="display: none;" id="errorCarDisplay"></p>
            </div>
        </div>
        <div class="row">
            <div id="carList" class="col">
        
            </div>
            <div id="carHud" class="col">
            
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Ajouter un nouveau Véhicule</h3>
                <form>
                    <div class="form-group">
                        <label for="formGroupExampleInput">immatriculation</label>
                        <input type="text" class="form-control" placeholder="imatriculation" oninput="checkLen('imatriculation',50)" id="imatriculation">
                        <p id="limitimatriculation">50/50</p><p id="erroimatriculation"></p>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">nombre de colis</label>
                        <input type="text" class="form-control" id="nbColis" placeholder="nombre de colis">
                        <p id="erronbColis"></p>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">volumeMax</label>
                        <input type="text" class="form-control" id="volumeMax" placeholder="volumeMax">
                        <p id="errovolumeMax"></p>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">poids Max</label>
                        <input type="text" class="form-control" id="weightMax" placeholder="weightMax">
                        <p id="erroweightMax"></p>
                    </div>
                    <button type="button" onclick="validate()" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
            <div class="col">
                <h3>liste de voiture libre</h3>
                <div id="freeCarList">
                </div>
                <label for="formGroupExampleInput">Recherche par immatriculation</label>
                <input type="text" class="form-control" placeholder="imatriculation" oninput="checkLen('imatriculationSch',50)" id="imatriculationSch">
                <p id="limitimatriculationSch">50/50</p><p id="erroimatriculationSch"></p>
                <button type="button" onclick="vecSch()" class="btn btn-primary">Search</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h1>Les Depots</h1>
            </div>
            <div class="col">
                <h1 id="titleCarInformation" >Mon dépot actuelle</h1>
            </div>
        </div>
        <div class="row">
            <div class="col" id="depotList">
                
            </div>
            <div class="col" id="currentDepot">
            </div>
        </div>
        <div class="row">
            <div class="col  justify-content-center text-center" >
                <div class="col px-md-5">
                    <button type="button" class="btn btn-primary btn-lg">PRECEDENT</button>
                </div>
                <div class="col px-md-5">
                    <button type="button" class="btn btn-primary btn-lg">SUIVANT</button>
                </div>
            </div>
            <div class="col justify-content-center text-center">
                <button type="button" class="btn btn-primary btn-lg">SELECTIONNER</button>
            </div>
        </div>
    </div>
        
    <?php
        echo "<div id=\"di\">" . $_SESSION["id_session"] . "</div>";
    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<script src="scriptHomeDriver/homeDriver.js"></script>
</html>