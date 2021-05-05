

let container = document.getElementById("containeur");


function getUser() {
    let request = new XMLHttpRequest();  
     request.open("GET","http://localhost:8888/users/get/list.php?limit=10&offset=0",true); 
     request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let tabulu = document.createElement("table");
                container.appendChild(tabulu);
                let tr1 =  document.createElement("tr");
                tabulu.appendChild(tr1);
                let th1 =  document.createElement("th");
                let th2 = document.createElement("th");
                th1.innerHTML = "nom";
                th2.innerHTML = "prénom";
                tr1.appendChild(th1);
                tr1.appendChild(th2);
                let ObjJson = JSON.parse(request.responseText);
                ObjJson.forEach(element => {
                    console.log(element["nom"]);
                    let bis =  document.createElement("tr");
                    tabulu.appendChild(bis);
                    let td1 = document.createElement("td");
                    let td2 = document.createElement("td");
                    td1.innerHTML = element["nom"];
                    td2.innerHTML = element["prenom"];
                    bis.appendChild(td1);
                    bis.appendChild(td2);
                });
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}



function getUserone() {
    let request = new XMLHttpRequest();  
     request.open("GET","http://localhost:8888/users/get/user.php?id=1",true); 
     request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                console.log(ObjJson);
                console.log(ObjJson.mail);

            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function addCar() {
    let imatriculation1 = document.getElementById("imatriculation").value;
    let nbColis1 = document.getElementById("nbColis").value;
    let volumeMax1 = document.getElementById("volumeMax").value;
    let weightMax1 = document.getElementById("weightMax").value;

    let request = new XMLHttpRequest();
    request.open("POST", "http://localhost:8888/vehicules/post/creat.php", true);
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
    
    let jsonToSend =
    {
        imatriculation: imatriculation1,
        nbColis: nbColis1,
        volumeMax: volumeMax1,
        weightMax: weightMax1
    };
    console.log("avant de partir " + jsonToSend);

    request.send(JSON.stringify(jsonToSend));
}    