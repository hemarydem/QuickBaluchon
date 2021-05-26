<?php
    require "../utls/utls.php";
    checIfsessionStarted();
    checkRightToBeHere(2);
    checkIfconnected();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="/css/home.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>HomeAdmin</title>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="20">
  <?php
      require "../utls/header/header.php";
  ?>
    <main>
      <div class="container">
        <div class="row">
          <nav class="col-sm-3">
            <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#section1" onclick="gestionMenu(1)">Gestion des clients</a></li>
              <li><a href="#section2" onclick="gestionMenu(2)">Gestion des livreurs</a></li>
              <li><a href="#section3" onclick="gestionMenu(3)">Gestion des particuliers</a></li>
              <li><a href="#section4" onclick="gestionMenu(4)">Gestion des colis</a></li>
              <li><a href="#section5" onclick="gestionMenu(5)">Gestion des administrateurs</a></li>
              <li><a href="#section6" onclick="gestionMenu(6)">Gestion des dépots</a></li>
            </ul>
          </nav>

          <div id="div" class="col-sm-9">

          </div>

        </div>
      </div>
    </main>
    <footer>

    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<script src="./scriptHomeAdmin/homeAdmin.js"></script>

</html>