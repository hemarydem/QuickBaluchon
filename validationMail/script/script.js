
/*ss="container" >
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

*/


let token = document.getElementById("token").innerHTML;
let mail = document.getElementById("mail").innerHTML;
let idUser = document.getElementById("di").innerHTML;
let activeUrl= "https://quickbaluchonservice.site/api/QuickBaluchon/users/get/getValue.php?tokenEmail=" + token + "&mail=" + mail;

let updateActiveUserAtributeUrl = "https://quickbaluchonservice.site/api/QuickBaluchonusers/post/update.php";

function  active(){
    let request = new XMLHttpRequest();  
    request.open("GET",activeUrl,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let result = JSON.stringify(request.responseText);
                    if(result['tokenEmail'] == token){
                        updateActiveUserAtribute(idUser);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}


function updateActiveUserAtribute(idData) {
    let json = {
        "id":idData,
        "active":1
    }
    let request = new XMLHttpRequest();  
    request.open("POST",updateActiveUserAtributeUrl,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    console.log(request.responseText);
                    let result = JSON.stringify(request.responseText);
                    console.log(result);
                    if(result.length <= 1) {
                        console.log(result["message"]);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(json));
}
    