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
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
        <?php
            require "../utls/header/header.php";
        ?>
        <div class="container" id="app">
            <div class="row ">
                <div class="col-md-4" style="background-color: white">
                </div>
                <div class="col-md-4" style="background-color: grey">
                    <div class="container" >
                            <div class="row">
                                <div class="col-md-2 col-md-offset-5">
                                    <p>mail</p>
                                    <input type="text" placeholder="mail address" id="mail">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-5">
                                    <label>passwords</label>
                                    <input type="text" placeholder="password" id="pssword">
                                    
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-4" style="background-color: white">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4" style="background-color: white">
                </div>
                <div class="col-md-4" style="background-color: grey">
                    <div class="container" >
                            <button onclick="signIn()">Sign In</button>
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
    <script src="./script/signIn.js"></script>
</html>
