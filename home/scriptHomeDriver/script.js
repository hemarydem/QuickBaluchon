
let divTOremov= document.getElementById("di");
let id = parseInt(divTOremov.innerHTML);
let carsList = document.getElementById("listeCars");
console.log(id);

document.getElementById("app").removeChild(divTOremov);

getIdCars();


function getIdCars() {
    let request = new XMLHttpRequest();  
    request.open("GET","http://localhost:8888/api/owns/get/getValue.php?idUser="+ id,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                console.log(request.responseText);
                let ObjJson = JSON.parse(request.responseText);
                console.log(ObjJson);
                if(ObjJson.hasOwnProperty("message")) {
                    carsList.innerHTML = ObjJson["message"];
                } else {
                    ObjJson.forEach(element=>{
                        getCar(element["idVehicule"]);
                    });
                    
                }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function getCar(carsIdRef) {
    let request = new XMLHttpRequest();  
    request.open("GET","http://localhost:8888/api/vehicules/get/vehicule.php?id=" + carsIdRef,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                console.log(request.responseText);
                let ObjJson = JSON.parse(request.responseText);
                console.log(ObjJson);
                if(ObjJson.hasOwnProperty("message")) {
                    carsList.innerHTML = ObjJson["message"];
                } else {

                }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function buildCarsTabelr(){
    let tabBase = document.createElement("table");
    let tr1 =  document.createElement("tr");
    let th1 =  document.createElement("th");
    let th2 = document.createElement("th");
    
    carsList.appendChild(tabulu);
    tabBase.appendChild(tr1);
    th1.innerHTML = "immatriculation";
    th2.innerHTML = "colis";
    tr1.appendChild(th1);
    tr1.appendChild(th2);

    OjectJSON.forEach(element => {
       //console.log(element["nom"]);
        let bis =  document.createElement("tr");
        tabBase.appendChild(bis);
        let td1 = document.createElement("td");
        let td2 = document.createElement("td");
        td1.innerHTML = element["imatriculation"];
        td2.innerHTML = element["6"];
        bis.appendChild(td1);
        bis.appendChild(td2);
    });

}


