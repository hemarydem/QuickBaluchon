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
<body>
<?php
    require "../utls/header/header.php";
?>
    <div class="container" id="app">
        <div class="row ">
            <div class="col-md-4" style="background-color: white" id="listeCars">
                <h2>Mes voitures</h2>
            </div>
            <div class="col-md-4" style="background-color: grey">
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
                        <button v-on:click="signIn()">Sign In</button>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
            </div>
        </div>
    </div>
    <?php
        echo "<div id=\"di\">".$_SESSION["id"]."</div>";
    ?>
</body>
<script>
    const app =  new Vue({
        el:"#app",
        data:{
            cars:[],
            paysheet:[]
        },
        methods:{
            getCars: function() {
                let destination = ["http://localhost:8888/front/home/homeDriver.php", "http://localhost:8888/front/home/homeAdmin.php", "http://localhost:8888/front/home/homeUser.php"];
                request.open("GET","http://localhost:8888/api/users/get/own.php?password=" + psswrd + "&mail=" + login ,true); 
                request.onreadystatechange = function() {
                    if(request.readyState == 4) {
                        if(request.status == 200) {

                            let ObjJson = JSON.parse(request.responseText);
                            console.log(ObjJson);
                            console.log(ObjJson["statut"]);
                            console.log(destination[ObjJson["statut"]]);
                            window.location.href = destination[ObjJson["statut"]];
                        } else {
                            alert("Error: returned status code " + request.status + " " + request.statusText);
                        }
                    }
                }
                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                request.send();
            },
            beforeMount(){
                this.getUnits()
            }
        }
    });
</script>

</html>