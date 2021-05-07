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
            </div>
            <div class="col-md-4" style="background-color: grey">
                <div class="container" >
                        
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
            </div>
        </div>
    <?php
        echo "<div id=\"di\">" . $_SESSION["id_session"] . "</div>";
    ?>
    </div>
</body>
<script src="scriptHomeDriver/script.js"></script>
</html>