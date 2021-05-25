/* FILE EDITE BY:
 *                 - YANIS TAGRI
 *                 - PEROCHON LÉO
 *                 - HAMED Rémy
 * FILE purpose:
 *  All fuction to help the driver to interact with his profile
 * 
 */
let apiPath = "https://quickbaluchonservice.site/api/QuickBaluchon";

let currentOffsetDepot = 0;
let maxDepotOffset = 10;

let divTOremov= document.getElementById("di");
let id = parseInt(divTOremov.innerHTML);
divTOremov.remove();

let carsList = document.getElementById("carList");
let divCarHub = document.getElementById("carHud");
getCarsListByDriverId();
getEmployedCar();
freeCarList();

getlistDepot();
getMaxOffset();

/*
 *  getCarsListByDriverId
 *
 * get driver's cars 
 * 
 * */

function getCarsListByDriverId() {
    let ObjJson;
    let request = new XMLHttpRequest();  
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/getCarsByUserId.php?id="+ id + "&active=1",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        carsList.innerHTML = ObjJson["message"];
                    } else {
                        carsList.innerHTML = "";
                        console.log(ObjJson);
                        if(ObjJson.length > 1) { 
                            ObjJson.forEach(element => {
                                if(parseInt(String(element["active"]),10) == 1) {
                                    let nwLine =  document.createElement("p");
                                    nwLine.innerHTML= element["imatriculation"];
                                    carsList.appendChild(nwLine);
                                    let buttOnElement = document.createElement("button");
                                    buttOnElement.setAttribute('onclick','displayCarsDATA(' + String(element["id"])+ ');');
                                    buttOnElement.innerHTML="fiche";
                                    carsList.appendChild(buttOnElement);

                                    let buttOnElementSupp = document.createElement("button");
                                    buttOnElementSupp.setAttribute('onclick','activeDesableCar(' + String(element["id"])+ ');');
                                    buttOnElementSupp.innerHTML="délier";
                                    carsList.appendChild(buttOnElementSupp);
                                }
                            });   
                        } else {
                            console.log(ObjJson);
                            let act = parseInt(String(ObjJson[0]["active"]),10);
                            console.log(act);
                            if(act == 1) {
                                let nwLine =  document.createElement("p");
                                nwLine.innerHTML= ObjJson[0]["imatriculation"];
                                carsList.appendChild(nwLine);
                                let buttOnElement = document.createElement("button");
                                buttOnElement.setAttribute('onclick','getCarBYID(' + String(ObjJson[0]["id"])+ ');');
                                buttOnElement.innerHTML="fiche";
                                carsList.appendChild(buttOnElement);

                                let buttOnElementSupp = document.createElement("button");
                                buttOnElementSupp.setAttribute('onclick','activeDesableCar(' + String(ObjJson[0]["id"])+ ');');
                                buttOnElementSupp.innerHTML="délier";
                                carsList.appendChild(buttOnElementSupp);
                            }
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
                        buttonSelection.setAttribute("onclick","switcheEmployeCar(" + String(ObjJson['id'])+")");
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

function switcheEmployeCar(idNwEmployCar) {
    let ObjJson;
    let oldEmployedcar;
    let newEmployedCar = {
        "id":idNwEmployCar,
        "employ":1
    }
    let request = new XMLHttpRequest();  
    request.open("GET", apiPath + "/vehicules/get/getCarsByUsed.php?id=" + id,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                if(ObjJson.hasOwnProperty("message")) {
                        if( "result not found" === String(ObjJson["message"])){
                            //changer la nouvelle voiture en voiture courrente
                            console.log("lanciennne voiture n'a pas été trouvé");
                        }
                    } else {
                        oldEmployedcar = {
                            "id":String(ObjJson[0]["id"]),
                            "employ":0
                        }
                        carUpdate(oldEmployedcar);
                        carUpdate(newEmployedCar);
                        getEmployedCar();
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function carUpdate(objData) {
    let ObjJson;
    let request = new XMLHttpRequest();  
    request.open("POST", apiPath + "/vehicules/post/update.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log(ObjJson);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(objData));
}

/*
* vehicule Forme code
*/

/*
 *  checkLen
 *
 *  arg id of an element and the max lenght of the string
 *  
 * check if the input don't have a to long string 
 * 
 * function is void
 * principal purpose is to give a feed back to the user
 */

function checkLen(StrElementId,limit) {
    let charWarning = ""; 
    let valuLen = parseInt(document.getElementById(StrElementId).value.length,10);
    let diff = limit - valuLen;
    let colorTrigger = false;
    if(diff >= 0)
        colorTrigger = true;
    charWarning = String(diff) + "/" + String(limit);
    let warningElement  = document.getElementById( "limit" + StrElementId);
    warningElement.innerHTML = charWarning;
    if(colorTrigger) {
        warningElement.style.color = "green";
    }else{
        warningElement.style.color = "red";
    }
}


/* checkInput
*
* arg 
* idInput
* len of the input
* boolean to know wich characters are allowed
*
*return a boolean
*/
function checkInput(idInput,lenMax,  OnlyNumber, OnlyLetter,mustNotContainSpace) {
    let trigger = true;
    let element =  String(document.getElementById(idInput).value);
    if(element.length == 0 || element == "") {                      // empty or not
        trigger = false;
        innerMessagetoElement(idInput,"ne peux être vide");
        return trigger
    }  
    element = element.trim();
    if(mustNotContainSpace) {                                       // supp space
        element = element.replace(/\s/, ''); 
    }   
    if(OnlyLetter){
        if(!/^[a-zA-Z]+$/.test(element))                                                 // check if there is onlyl etter
            trigger = false;
        if(!trigger){
            innerMessagetoElement(idInput,"pas de chiffre ni accent");       
            return trigger;
        }
    }   
    if(OnlyNumber){
        if(!/^\d+$/.test(element))                                                 // check if there is onlyl etter
            trigger = false;                         // check if there is only number
        if(!trigger){
            innerMessagetoElement(idInput,"pas de lettre");
            return trigger;
        }
    }   
    if(element.length >lenMax) {                                     // the lenght
        trigger = false;
        innerMessagetoElement(idInput,"trop grand");
        return trigger;
    }   
    if(trigger)                                                     //void <p> element because no error to signal
        innerMessagetoElement(idInput,"");
    return trigger;
}

function innerMessagetoElement(idInpuEl,strMessageError) {                          
    document.getElementById("erro" + idInpuEl).innerHTML = "";
    document.getElementById("erro" + idInpuEl).innerHTML = strMessageError;
}


function validate() {
    console.log("getDataVehicule()");
    getDataVehicule("----array----");
    let canContainSpace = false;
    let mustNotContainSpace = true;
    let OnlyNumber = true;
    let OnlyNumberNot = false;
    let OnlyLetter = true;
    let OnlyLetterNot = false;

    let allowedSend = [true,true,true,true];

    //vehicule inputs

    allowedSend[0] = checkInput("imatriculation",50,OnlyNumberNot,OnlyLetterNot,mustNotContainSpace);
    
    allowedSend[1]= checkInput("nbColis",50,OnlyNumber,OnlyLetterNot,mustNotContainSpace);
    
    allowedSend[2] = checkInput("volumeMax",50,OnlyNumber,OnlyLetterNot,mustNotContainSpace);

    allowedSend[3] = checkInput("weightMax",50,OnlyNumber,OnlyLetterNot,mustNotContainSpace);


    console.log(allowedSend);
    let block = 0;
    allowedSend.forEach(element => {            // check if each input was validate
        if(element == false){
            console.log("envoie pas");
            block = 1;
        }
    });
    if(block == 0) {
        addVehicule(getDataVehicule());
    }
    console.log(" FIN");
}


function  getDataVehicule() {
    let immatriculation = document.getElementById("imatriculation").value;
    let nbColis = document.getElementById("nbColis").value;
    let volumeMax = document.getElementById("volumeMax").value;//
    let weightMax= document.getElementById("weightMax").value;
    immatriculation = immatriculation.trim();
    nbColis = nbColis.trim();
    volumeMax = volumeMax.trim();
    weightMax= weightMax.trim();

    immatriculation = immatriculation.replace(/\s/, ''); 
    nbColis = nbColis.replace(/\s/, '');
    volumeMax = volumeMax.replace(/\s/, ''); 
    weightMax = weightMax.replace(/\s/, '');

    let array = [immatriculation,nbColis,volumeMax,weightMax];
    console.log("getDataVehicule()");
    console.log("----array----");
    console.log(array);
    return array;
}

function addVehicule(arrayDataVehicule) {
    console.log("addVehicule()");
    console.log("----arrayDataVehicule-----");
    console.log(arrayDataVehicule);
    let jsonToSend = {
        "imatriculation":arrayDataVehicule[0],
        "nbColis":arrayDataVehicule[1],
        "volumeMax":arrayDataVehicule[2],
        "weightMax":arrayDataVehicule[3],
        "employ":0,
        "active":1
    };
    let request = new XMLHttpRequest();  
    request.open("POST","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/post/creat.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error add vehicule");
                        console.log(ObjJson["message"]);
                        alert(ObjJson["message"]);
                    } else {
                        addOwn(ObjJson["id"]);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}


function addOwn(vehId) {
    console.log("addOwn()");
    console.log("vehId -> " + vehId);
    let idU = id;
    let idVeh = vehId;
    console.log("idU -> " + idU);
    console.log("idVeh -> " + idVeh);
    let jsonToSend = {
        "idVehicule":idVeh,
        "idUser":idU
    };
    let request = new XMLHttpRequest();  
    request.open("POST","https://quickbaluchonservice.site/api/QuickBaluchon/owns/post/creat.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error add vehicule");
                        console.log(ObjJson["message"]);
                    } else {
                        getCarsListByDriverId();
                        alert("votre liste de véhicule propriétaire est mise à jour");
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}

/*
*list car no free
*/

function freeCarList(){
    console.log("freeCarList()");
    let freeVHList = document.getElementById("freeCarList");
    let request = new XMLHttpRequest();  
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/getValue.php?active=0",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                console.log(ObjJson);
                if(ObjJson.hasOwnProperty("message")) {
                    console.log("error");
                    console.log(ObjJson["message"]);
                } else {
                    freeVHList.innerHTML = "";
                    if(ObjJson.length > 1){ 
                        ObjJson.forEach(element => {
                            let nwLine =  document.createElement("p");
                            nwLine.innerHTML= element["imatriculation"];
                            freeVHList.appendChild(nwLine);
                            let buttOnElement = document.createElement("button");
                            buttOnElement.setAttribute('onclick','getFreeCar(' + String(element["id"])+ ');');
                            buttOnElement.innerHTML="s'assigner";
                            freeVHList.appendChild(buttOnElement);
                        });   
                    } else {
                        let nwLine =  document.createElement("p");
                        nwLine.innerHTML= ObjJson[0]["imatriculation"];
                        freeVHList.appendChild(nwLine);
                        let buttOnElement = document.createElement("button");
                        buttOnElement.setAttribute('onclick','getFreeCar(' + String(ObjJson[0]["id"])+ ');');
                        buttOnElement.innerHTML="s'assigner";
                        freeVHList.appendChild(buttOnElement);
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


function getFreeCar(vecId) {
    console.log("getFreeCar()");
    console.log("vecId -> " + vecId);
    let idVeh = vecId;
    console.log("idVeh -> " + idVeh);
    let jsonToSend = {
        "id":idVeh,
        "active":1
    };
    let request = new XMLHttpRequest();  
    request.open("POST","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/post/update.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error add vehicule");
                        console.log(ObjJson["message"]);
                    } else {
                        addOwn(idVeh);
                        getCarsListByDriverId();
                        freeCarList();
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}

/*
 * search input functions
 */

function vecSch() {
    let canContainSpace = false;
    let mustNotContainSpace = true;
    let OnlyNumber = true;
    let OnlyNumberNot = false;
    let OnlyLetter = true;
    let OnlyLetterNot = false;
    if(checkInput("imatriculationSch",50,OnlyNumberNot,OnlyLetterNot,mustNotContainSpace)){
        let findImm = document.getElementById("imatriculationSch").value;
        findImm = findImm.trim();
        findImm = findImm.replace(/\s/, '');
        FreeCarSearch(findImm);
    }
}


function FreeCarSearch(immSch) {
    let data = String(immSch);
    let freeVHList = document.getElementById("freeCarList");
    console.log("FreeCarSearch()");
    let request = new XMLHttpRequest();  
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/list.php?limit=20&offset=0&imatriculation=" + data + "&active=0",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error");
                        console.log(ObjJson["message"]);
                    } else {
                        freeVHList.innerHTML = "";
                        if(ObjJson.length > 1){ 
                            ObjJson.forEach(element => {
                                let nwLine =  document.createElement("p");
                                nwLine.innerHTML= element["imatriculation"];
                                freeVHList.appendChild(nwLine);
                                let buttOnElement = document.createElement("button");
                                buttOnElement.setAttribute('onclick','getFreeCar(' + String(element["id"])+ ');');
                                buttOnElement.innerHTML="s'assigner";
                                freeVHList.appendChild(buttOnElement);
                            });   
                        } else {
                            let nwLine =  document.createElement("p");
                            nwLine.innerHTML= ObjJson[0]["imatriculation"];
                            freeVHList.appendChild(nwLine);
                            let buttOnElement = document.createElement("button");
                            buttOnElement.setAttribute('onclick','getFreeCar(' + String(ObjJson[0]["id"])+ ');');
                            buttOnElement.innerHTML="s'assigner";
                            freeVHList.appendChild(buttOnElement);
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

/**
 * *
 * *
 * desapble car featur
 * 
*/


function activeDesableCar(idVh){
    console.log("activeDesableCar()");
    let data = parseInt(String(idVh),10);
    console.log(data);
    let request = new XMLHttpRequest();  
    let url = apiPath + "/vehicules/get/vehicule.php?id=" + String(data);
    console.log(url);
    request.open("GET", url,true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                console.log(ObjJson);
                if(ObjJson.hasOwnProperty("message")) {
                    console.log("error desabbleOwn ");
                    console.log(ObjJson["message"]);
                } else {
                    if(ObjJson["employ"] == 1) {
                        alert("vous ne pouvez pas détacher le véhicule que vous utliser");
                    } else {
                        desabbleOwn(data);
                        desabbleCar(data);
                        getCarsListByDriverId();
                        freeCarList();
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

function desabbleOwn(vehId) {
    console.log("desabbleOwn()");
    console.log("vehId -> " + vehId);
    let idU = id;
    let idVeh = vehId;
    console.log("idU -> " + idU);
    console.log("idVeh -> " + idVeh);
    let jsonToSend = {
        "idVehicule":idVeh,
        "idUser":idU,
        "active":0
    };
    let request = new XMLHttpRequest();  
    request.open("POST","https://quickbaluchonservice.site/api/QuickBaluchon/owns/post/creat.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error desabbleOwn ");
                        console.log(ObjJson["message"]);
                    } 
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}

function desabbleCar(vehId) {
    console.log("desabbleCar()");
    console.log("vehId -> " + vehId);
    let idU = id;
    let idVeh = vehId;
    console.log("idU -> " + idU);
    console.log("idVeh -> " + idVeh);
    let jsonToSend = {
        "id":idVeh,
        "active":0
    };
    let request = new XMLHttpRequest();  
    request.open("POST","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/post/update.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error add vehicule");
                        console.log(ObjJson["message"]);
                    } 
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}

/*
*
* display depot functions 
*/

function getlistDepot() {
    let depotList = document.getElementById("depotList");
    let request = new XMLHttpRequest();
    request.open("GET", apiPath + "/depots/get/list.php?limit=5&offset=" + currentOffsetDepot,true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200) {
                let ObjJson = JSON.parse(request.responseText);
                console.log(ObjJson);
                if(ObjJson.hasOwnProperty("message")) {
                    console.log(ObjJson["message"]);
                } else if(ObjJson.length > 0) {
                    if(ObjJson.length == 1) {
                        depotList.innerHTML = "";
                        let nwLine = document.createElement("p");
                        nwLine.className = "btn-primary";
                        nwLine.innerHTML = ObjJson["ville"] +" "+ ObjJson[0]["adresse"];
                        nwLine.setAttribute("onclick", "getDepotData(" + String(ObjJson[0]["id"]) + ")");
                        depotList.appendChild(nwLine);
                    } else {
                        depotList.innerHTML = "";
                        ObjJson.forEach(element => {
                            let nwLine = document.createElement("p");
                            nwLine.className = "btn-primary";
                            nwLine.innerHTML = element["ville"] +" "+ element["adresse"];
                            nwLine.setAttribute("onclick", "getDepotData(" + String(element["id"]) + ")");
                            depotList.appendChild(nwLine);
                        });
                    }
                } else {
                    depotList.innerHTML = "";
                    let nwLine = document.createElement("p");
                    nwLine.innerHTML = "no data found";
                    depotList.appendChild(nwLine);
                }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function getMaxOffset() {
    let ObjJson;
    let request = new XMLHttpRequest();
    request.open("GET", apiPath + "/depots/get/count.php",true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log(ObjJson);
                    } else {
                        console.log("setting");
                        maxDepotOffset = ObjJson["total"] - 5;
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}




function next() {
    let offset = currentOffsetDepot + 5;
    if(offset > maxDepotOffset) {
        return currentOffsetDepot;
    } else {
        currentOffsetDepot = offset;
        getlistDepot();
    }
}

function last() {
    let offset = currentOffsetDepot - 5;
    if(offset < 0) {
        currentOffsetDepot = 0;
        return currentOffsetDepot;
    } else {
        currentOffsetDepot = offset;
        getlistDepot();
    }
}

/**
 * display data of a debot who's not assigned
 *  */ 
function getDepotData() {
    let div = document.getElementById("currentDepot");
    let ObjJson;
    let request = new XMLHttpRequest();
    request.open("GET", apiPath + "/depots/get/depot.php?id="+ String(id) ,true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log(ObjJson);
                        div.innerHTML = "no data found";
                    } else {
                        div.innerHTML = "";
                        let villeTitre = document.createElement("h4");
                        let addressTitre = document.createElement("h4");
                        let codePostalTitre = document.createElement("h4");
                        
                        let ville = document.createElement("p");
                        let adresse = document.createElement("p");
                        let codePostale = document.createElement("p");

                        let buttton = document.createElement("button");
                        buttton.setAttribute("onclick","depotAssignementProcesse(" + String(ObjJson["id"]) + ", " + String(id) + ")");

                        villeTitre.innerHTML = "Ville";
                        addressTitre.innerHTML = "Adresse";
                        codePostalTitre.innerHTML = "CodePostale";

                        ville.innerHTML = ObjJson["ville"];
                        adresse.innerHTML = ObjJson["adresse"];
                        codePostale.innerHTML = ObjJson["codePostale"];

                        div.appendChild(villeTitre);
                        div.appendChild(ville);
                        div.appendChild(addressTitre);
                        div.appendChild(adresse);
                        div.appendChild(codePostalTitre);
                        div.appendChild(codePostale);
                        div.appendChild(buttton);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

/*deposits/get/list.php?limit=100&offset=0&idUser=96 */

/**
 * 
 * display the current depot
 */
function getCurrentDEPOT(){
    let div = document.getElementById("currentDepot");
    let ObjJson;
    let request = new XMLHttpRequest();
    request.open("GET", apiPath + "/deposits/get/list.php?limit=1&offset=0&idUser="+ String(id)+"&active=1" ,true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log(ObjJson);
                        div.innerHTML = "no data found";
                    } else {
                        div.innerHTML = "";
                        let villeTitre = document.createElement("h4");
                        let addressTitre = document.createElement("h4");
                        let codePostalTitre = document.createElement("h4");
                        
                        let ville = document.createElement("p");
                        let adresse = document.createElement("p");
                        let codePostale = document.createElement("p");

                        villeTitre.innerHTML = "Ville";
                        addressTitre.innerHTML = "Adresse";
                        codePostalTitre.innerHTML = "CodePostale";

                        ville.innerHTML = ObjJson["ville"];
                        adresse.innerHTML = ObjJson["adresse"];
                        codePostale.innerHTML = ObjJson["codePostale"];

                        div.appendChild(villeTitre);
                        div.appendChild(ville);
                        div.appendChild(addressTitre);
                        div.appendChild(adresse);
                        div.appendChild(codePostalTitre);
                        div.appendChild(codePostale);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}



function depotAssignementProcesse(depotIdA, userIdA) {
    let request = new XMLHttpRequest();  
    request.open("GET",apiPath + "/deposits/get/deposit.php?idDepot=" +String(depotIdA) + "&idUser=" + String(userIdA) + "&active=1",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error");
                        console.log(ObjJson["message"]);
                    } else {
                        depotAssignement(ObjJson["idDepot"], userIdA, false);
                        depotAssignement(String(depotIdA), String(userIdA), true);
                        getCurrentDEPOT();
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}




function depotAssignement(depotId, userId, activeBoolean){
    console.log("depotAssignement()");
    console.log("depotId -> " + depotId);
    console.log("userId -> " + userId);
    console.log("activeBoolean -> " + activeBoolean);
    let jsonToSend;

    if(activeBoolean) {
        jsonToSend = {
            "idDepot":depotId,
            "idUser":userId,
            "active":1
        };
    } else {
        jsonToSend = {
            "idDepot":depotId,
            "idUser":userId,
            "active":0
        };
    }
    let request = new XMLHttpRequest();  
    request.open("POST",apiPath + "/deposits/post/creat.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error");
                        console.log(ObjJson["message"]);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}