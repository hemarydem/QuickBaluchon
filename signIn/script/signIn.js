let webSitePath ="https://quickbaluchonservice.site/QuickBaluchon";
let homePage =[webSitePath + "/home/homeDriver.php", webSitePath + "/home/homeAdmin.php",webSitePath + "/home/homeUser.php"];


function signIn() {
    let login = document.getElementById("mail").value;
    let psswrd = document.getElementById("pssword").value;
    
    let request = new XMLHttpRequest();
    
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/users/get/signIn.php?password=" + psswrd + "&mail=" + login ,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                let num = ObjJson["statut"].toString();
                num = parseInt(num);
                num--;
                console.log(num);
                console.log(homePage);
                console.log(homePage[num]);
                
                window.location.href = homePage[num];
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}






/*
function getUser() {
    let login = document.getElementById("mail").value;
    let psswrd = document.getElementById("pssword").value;
    let request = new XMLHttpRequest();  
     request.open("GET","http://localhost:8888/users/get/getValue.php?password=" + psswrd + "&mail=" + login ,true); 
     request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                console.log(ObjJson);
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}*/
