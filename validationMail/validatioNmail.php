<?php
if(!isset($_GET['mail']) || !isset($_GET['token']) ) {
   header("location: https://quickbaluchonservice.site");
}
?>

<?php
    require "../utls/utls.php";
    checIfsessionStarted();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container" >
    <div class="col-md-4 text-center"> 
    <p id="token"><?php
    echo $_GET['token'];
    ?></p>
    </div>
</div>>
<div class="container" >
    <div class="col-md-4 text-center"> 
        <p id="mail"><?php echo $_GET['mail'];?></p>
    </div>
</div>>

<div class="container" id="app">
    <div class="col-md-4 text-center"> 
        <button id="singlebutton" name="singlebutton" onclick="active()" class="btn btn-primary">CONFIRME SIGN UP</button> 
    </div>
</div>
<?php
    echo "<div id=\"di\"  style=\"display: none;\">" . $_GET["id"] . "</div>";
?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<script src="./scipt/scipt.js"></script>
</html>