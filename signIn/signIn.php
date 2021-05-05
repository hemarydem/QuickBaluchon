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
                                <input type="text" value="DKKDKS@gmail.com" placeholder="mail address" id="mail">
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
                            <button v-on:click="signIn()">Sign In</button>
                    </div>
                </div>
                <div class="col-md-4" style="background-color: white">
                </div>
            </div>
        </div>
    </body>
    <script>
    const app =  new Vue({
        el:"#app",
        methods:{
            signIn: function() {
                let login = document.getElementById("mail").value;
                let psswrd = document.getElementById("pssword").value;
                let request = new XMLHttpRequest();  
                request.open("GET","http://localhost:8888/api/users/get/getValue.php?password=" + psswrd + "&mail=" + login ,true); 
                request.onreadystatechange = function() {
                    if(request.readyState == 4) {
                        if(request.status == 200) {
                            console.log("ok");
                            
                            let ObjJson = JSON.parse(request.responseText);
                            //console.log(ObjJson);
                            for (const [key, value] of Object.entries(ObjJson)) {
                                //console.log(`${key}: ${value}`);
                                let stringKey = `${key}`;
                                let stringValue = `${value}`;
                                let stringForSetCookie = stringKey + "=" + stringValue;
                                console.log("\n ->" + stringForSetCookie);
                                document.cookie=stringForSetCookie;
                            }
                            console.log(document.cookie);
                            //document.cookie = "name=oeschge;";
                            window.location.href = "http://localhost:8888/front/test.php";
                        } else {
                            alert("Error: returned status code " + request.status + " " + request.statusText);
                        }
                    }
                }
                request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                request.send();
            }
        }
    });
</script>
</html>
