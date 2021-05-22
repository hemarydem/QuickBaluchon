let webSitePath ="https://quickbaluchonservice.site/QuickBaluchon";
function signIn() {
    let login = document.getElementById("mail").value;
    let psswrd = document.getElementById("pssword").value;
    
    let request = new XMLHttpRequest();
    
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/users/get/signIn.php?password=" + psswrd + "&mail=" + login ,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                let num = String(ObjJson["statut"]);
                num = parseInt(num,10);
                console.log(ObjJson);
                console.log(num);
                switch (num) {
                    case 1:
                        window.location.href = webSitePath + "/home/homeDriver.php";
                        break;
                    case 2:
                        window.location.href =  webSitePath + "/home/homeAdmin.php";
                        break;
                    case 3:
                        window.location.href = webSitePath + "/home/homeUser.php"
                        break;
                }
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
