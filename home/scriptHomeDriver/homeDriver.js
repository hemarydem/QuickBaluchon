/* FILE EDITE BY:
 *                 - YANIS TAGRI
 *                 - PEROCHON LÉO
 *                 - HAMED Rémy
 * FILE purpose:
 *  All fuction to help the driver to interact with his profile
 * 
 */
let apiPath = "https://quickbaluchonservice.site/api/QuickBaluchon"

let divTOremov= document.getElementById("di");
let id = parseInt(divTOremov.innerHTML);
divTOremov.remove();

let carsList = document.getElementById("carList");
let divCarHub = document.getElementById("carHud");
getCarsListByDriverId();
getEmployedCar();



/*
 *  getCarsListByDriverId
 *
 * get driver's cars 
 * 
 * */

function getCarsListByDriverId() {
    let ObjJson;
    let request = new XMLHttpRequest();  
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/getCarsByUserId.php?id="+ id,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        carsList.innerHTML = ObjJson["message"];
                    } else {
                        carsList.innerHTML = "";
                        
                        if(ObjJson.length > 1){ 
                            ObjJson.forEach(element => {
                                let nwLine =  document.createElement("p");
                                nwLine.innerHTML= element["imatriculation"];
                                carsList.appendChild(nwLine);
                                let buttOnElement = document.createElement("button");
                                buttOnElement.setAttribute('onclick','displayCarsDATA(' + String(element["id"])+ ');');
                                buttOnElement.innerHTML="fiche";
                                carsList.appendChild(buttOnElement);
                            });   
                        } else {
                            let nwLine =  document.createElement("p");
                            nwLine.innerHTML= ObjJson[0]["imatriculation"];
                            carsList.appendChild(nwLine);
                            let buttOnElement = document.createElement("button");
                            buttOnElement.setAttribute('onclick','getCarBYID(' + String(ObjJson[0]["id"])+ ');');
                            buttOnElement.innerHTML="fiche";
                            buttOnElement.classList.add('btn btn-success');
                            carsList.appendChild(buttOnElement);
                        }
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function getEmployedCar() {
    let ObjJson;
    let request = new XMLHttpRequest();  
    request.open("GET", apiPath + "/vehicules/get/getCarsByUsed.php?id=" + id,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        carsList.innerHTML = ObjJson["message"];
                    } else {
                        divCarHub.innerHTML = "";
                        let immatriculatio_h4 = document.createElement("h4");
                        let maxWei_h4 = document.createElement("h4");
                        let vol_h4 = document.createElement("h4");

                        let imatriculationElementHtml= document.createElement("p");
                        imatriculationElementHtml.setAttribute("id", "immaEmploy");

                        let weightElementHtml = document.createElement("p");
                        weightElementHtml.setAttribute("id","wEmploy");

                        let volumeMaxElementHtml = document.createElement("p");
                        volumeMaxElementHtml.setAttribute("id","volEmploy");

                        imatriculationElementHtml.innerHTML = ObjJson[0]['imatriculation'];
                        weightElementHtml.innerHTML = ObjJson[0]['weightMax'];
                        volumeMaxElementHtml.innerHTML = ObjJson[0]['volumeMax'];
                        immatriculatio_h4.innerHTML = "immatriculation";
                        maxWei_h4.innerHTML = "Poids supporter";
                        vol_h4.innerHTML = "volume limite";
                        divCarHub.appendChild(immatriculatio_h4);
                        divCarHub.appendChild(imatriculationElementHtml);
                        divCarHub.appendChild(maxWei_h4);
                        divCarHub.appendChild(weightElementHtml);
                        divCarHub.appendChild(vol_h4);
                        divCarHub.appendChild(volumeMaxElementHtml);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function displayCarsDATA(uID) {
    let ObjJson;
    let request = new XMLHttpRequest();  
    request.open("GET", apiPath + "/vehicules/get/vehicule.php?id=" + uID,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        document.getElementById("errorCarDisplay").innerHTML = ObjJson["message"];
                    } else {
                        document.getElementById("errorCarDisplay").innerHTML ="";
                        divCarHub.innerHTML = "";
                        let immatriculatio_h4 = document.createElement("h4");
                        let maxWei_h4 = document.createElement("h4");
                        let vol_h4 = document.createElement("h4");

                        let imatriculationElementHtml= document.createElement("p");

                        let weightElementHtml = document.createElement("p");

                        let volumeMaxElementHtml = document.createElement("p");

                        imatriculationElementHtml.innerHTML = String(ObjJson['imatriculation']);
                        weightElementHtml.innerHTML = ObjJson['weightMax'];
                        volumeMaxElementHtml.innerHTML = ObjJson['volumeMax'];
                        immatriculatio_h4.innerHTML = "immatriculation";
                        maxWei_h4.innerHTML = "Poids supporter";
                        vol_h4.innerHTML = "volume limite";
                        divCarHub.appendChild(immatriculatio_h4);
                        divCarHub.appendChild(imatriculationElementHtml);
                        divCarHub.appendChild(maxWei_h4);
                        divCarHub.appendChild(weightElementHtml);
                        divCarHub.appendChild(vol_h4);
                        divCarHub.appendChild(volumeMaxElementHtml);

                        let buttonSelection = document.createElement("input");
                        buttonSelection.setAttribute("type", "button");
                        buttonSelection.setAttribute("classe","btn btn-primary"); 
                        buttonSelection.setAttribute("value","SELECTION VEHICULE PRINCIPALE");
                        divCarHub.appendChild(buttonSelection);
                        document.getElementById("titleCarInformation").innerHTML="";
                        document.getElementById("titleCarInformation").innerHTML="Fiche voiture";
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}
