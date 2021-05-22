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



let containerLeft = document.getElementById("leftcont");
let containerCenter = document.getElementById("centerCont");

let clListElement = document.getElementById("COLISLIST");


let elementDepotList = document.getElementById("depoliste");

let maxOffset = getoffsetMax(apiPath + "/depots/get/count.php");

let depotGlobal = null;
//let containerLeft = document.getElementById("leftcont");
document.getElementById("body").removeChild(divTOremov);

getCarsListByDriverId();
getDepot();
/*
 *  getCarsListByDriverId
 *
 *  arg driver's id
 *  
 * get the list of cars and data of drivers car by calling api
 * 
 * return a void
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
                        containerLeft.innerHTML = ObjJson["message"];
                    } else {
                        containerLeft.innerHTML = "";
                        let tabBase = document.createElement("table");
                        containerLeft.appendChild(tabBase);
                        let tr1 =  document.createElement("tr");
                        let th1 =  document.createElement("th");
                        let th2 = document.createElement("th");
                        th1.innerHTML = "immatriculation";
                        th2.innerHTML = "colis";
                        containerLeft.appendChild(tabBase);
                        tabBase.appendChild(tr1);
                        tr1.appendChild(th1);
                        tr1.appendChild(th2);
                        ObjJson.forEach(element => {
                            let nwLine =  document.createElement("tr");
                            tabBase.appendChild(nwLine);
                            let td1 = document.createElement("td");
                            let td2 = document.createElement("td");
                            let buttOnElement = document.createElement("button");
                            buttOnElement.setAttribute('onclick','getCarBYID(' +String(element["id"])+ ');');
                            td1.innerHTML = String(element["imatriculation"]);
                            td2.innerHTML = String(element["nbColis"]);
                            nwLine.appendChild(td1);
                            nwLine.appendChild(td2);
                            nwLine.appendChild(buttOnElement);
                            let select = parseInt(element["nbColis"], 10);
                            if( select == 1) {
                            nwLine.style.backgroundColor = 'green';
                            }
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

function getCarBYID(idCar) {
    let ObjJson;
    let request = new XMLHttpRequest();  
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/vehicule.php?id="+ idCar,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        containerLeft.innerHTML = ObjJson["message"];
                    } else {
                        let divBase = document.createElement("div");
                        containerCenter.innerHTML="";
                        containerCenter.appendChild(divBase);
                        let h2 = document.createElement("h2");
                        h2.innerHTML = "inforamtion voiture";
                        divBase.appendChild(h2);
                        let p1 =  document.createElement("p");
                        let p2 =  document.createElement("p");
                        let p3 =  document.createElement("p");
                        let p4 =  document.createElement("p");

                        let label1 =  document.createElement("label");
                        let label2 =  document.createElement("label");
                        let label3 =  document.createElement("label");
                        let label4 =  document.createElement("label");
                        label1.innerHTML = "imatriculation";
                        label2.innerHTML = "nbColis";
                        label3.innerHTML = "volumeMax";
                        label4.innerHTML = "weightMax";
                
                        p1.innerHTML = ObjJson["imatriculation"];
                        p2.innerHTML = ObjJson["nbColis"];
                        p3.innerHTML = ObjJson["volumeMax"];
                        p4.innerHTML = ObjJson["weightMax"];
                        divBase.appendChild(label1);
                        divBase.appendChild(p1);
                        divBase.appendChild(label2);
                        divBase.appendChild(p2);
                        divBase.appendChild(label3);
                        divBase.appendChild(p3);
                        divBase.appendChild(label4);
                        divBase.appendChild(p4);
                        let buttOnElement = document.createElement("button");
                        buttOnElement.setAttribute('onclick',"selecting(" + String(idCar)+ ");");
                        divBase.appendChild(buttOnElement);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}



function getCarBYIDForDelivery(idCar) {
    let ObjJson;
    let request = new XMLHttpRequest();  
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/vehicule.php?id="+ idCar,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        containerLeft.innerHTML = ObjJson["message"];
                    } else {
                    return ObjJson;
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
 *  checkLen
 *
 *  arg id of an element and the max lenght of the string
 *  
 * check if the input don't have a to long string 
 * 
 * function is void
 * */

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

/*
 *  validate
 *
 * check general of the inputs
 * if not to long
 * if there is appropriate chars
 * 
 * function is void
 * 
 * it call ajaxSendPost()
 * */

function validate() {
    console.log("ok");
    let canContainSpace = false;
    let mustNotContainSpace = true;
    let OnlyNumber = true;
    let OnlyNumberNot = false;
    let OnlyLetter = true;
    let OnlyLetterNot = false;

    let allowedSend = [true,true,true,true];
    
    allowedSend[0] = checkInput("imatriculation",50,OnlyNumberNot,OnlyLetterNot,mustNotContainSpace);
    
    allowedSend[1]= checkInput("nbColis",50,OnlyNumber,OnlyLetterNot,mustNotContainSpace);
    
    allowedSend[2] = checkInput("volumeMax",50,OnlyNumber,OnlyLetterNot,mustNotContainSpace);

    allowedSend[3] = checkInput("weightMax",50,OnlyNumber,OnlyLetterNot,mustNotContainSpace);

    console.log(allowedSend);
    let block = 0;
    allowedSend.forEach(element => {
        if(element == false){
            console.log("envoie pas");
            block = 1;
        }
    });
    console.log("ok");
    if(block == 0) {
        ajaxSendPost(getData(),"https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/post/creat.php");
    }
    console.log(" FIN");
}



function ajaxSendPost(data,urlLink) {

    let jsonToSend = {
        imatriculation:data[0],
        nbColis:data[1],
        volumeMax:data[2],
        weightMax:data[3]
    };
    let request = new XMLHttpRequest();  
    request.open("POST",urlLink,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjeJson =  ObjJson = JSON.parse(request.responseText);
                    console.log(ObjeJson);
                    creatOwnerOnCar(id,ObjeJson['id'],"https://quickbaluchonservice.site/api/QuickBaluchon/owns/post/creat.php");
                    getCarsListByDriverId();
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}


function creatOwnerOnCar(idDriver,idCar,urlLink) {
    console.log("1010101010");
    let jsonToSend = {
        idVehicule:idCar,
        idUser:idDriver
    };
    let request = new XMLHttpRequest();  
    request.open("POST",urlLink,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjeJson =  ObjJson = JSON.parse(request.responseText);
                    console.log(ObjeJson);
                    
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}






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



/*
*get data
*function do get data in the input
*
* no argument
*
* return array
*/
function  getData() {
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
    return array;
}


function getDepot(arg) {
    let offset = document.getElementById("divCheckbox");
    let save = parseInt(offset.innerHTML,10);
    if(arg == 0) {
        offset.innerHTML = "";
        save =  save - 10;
        if(save < 0) {
            save = 0;
        }
        offset.innerHTML =  save;
    }
    let request = new XMLHttpRequest();  
    request.open("GET",apiPath + "/depots/get/list.php?limit=" + 10 +"&offset=" + save,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    if(!(request.responseText.length == 0)) {
                        let ObjeJson =  ObjJson = JSON.parse(request.responseText);
                        console.log(ObjeJson);
                        elementDepotList.innerHTML = "";
                        ObjeJson.forEach(Element =>{
                            let nwLine =  document.createElement("d");
                            nwLine.setAttribute('onclick','(setDepoTGlobal' + String(Element["id"]) + ');');
                            nwLine.innerHTML = Element["ville"];
                            elementDepotList.appendChild(nwLine);
                        });
                        if(arg == 1) {
                        let save = parseInt(offset.innerHTML,10);
                        offset.innerHTML = "";
                        save += 10;
                        if(save > maxOffset)
                            save = maxOffset - 1;
                        offset.innerHTML =  save;
                        }
                    } else {
                        console.log("empty");
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}

function setDepoTGlobal(idToset) {
    depotGlobal = idToset;
}



function getColist(idOfColisDepot) {
    let baliseToFilled = document.getElementById("COLISLIST");
    let request = new XMLHttpRequest();  
    request.open("GET",apiPath + "/colis/get/getValue.php?idDepot=" + idOfColisDepot +"?sendingStatut=0",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                        let  ObjJson = JSON.parse(request.responseText);
                        return ObjJson;
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}


function getoffsetMax(url){
    let request = new XMLHttpRequest();  
    request.open("GET", url, true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                        let ObjeJson =  ObjJson = JSON.parse(request.responseText);
                        console.log("offset max  = " + String(ObjeJson["total"]));
                        return parseInt(ObjeJson["total"],10);
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}


function validateForZoneMax() {

    let idInput2  = "zoneMax";
    let trigger = true;
    let element =  String(document.getElementById(idInput2).value);
    if(element.length == 0 || element == "") {                      // empty or not
        trigger = false;
        innerMessagetoElement(idInput2,"ne peux être vide");
        return trigger
    }  
    element = element.trim();          
    element = element.replace(/\s/, '');    // supp space
    if(!/^\d+$/.test(element))                                                 // check if there is onlyl etter
        trigger = false;                         // check if there is only number
    if(!trigger){
        innerMessagetoElement(idInput2,"pas de lettre");
        return trigger;
    }
    if(trigger) {
        innerMessagetoElement(idInput2,"");
        ajaxZoneMax(apiPath + "/users/post/update.php");
    }                                                     //void <p> element because no error to signal
}



function ajaxZoneMax(urlLink) {
    let zone = document.getElementById("zoneMax").value;
    zone = parseInt(zone,10);
    let jsonToSend = {
        zoneMaxDef:zone,
        id:id
    };
    let request = new XMLHttpRequest();  
    request.open("POST",urlLink,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjeJson =  ObjJson = JSON.parse(request.responseText);
                    console.log(ObjeJson);
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}




function selecting(idVeh) {
    //selection celui déjà a un
    let idtoStop = getAllreadySellectVehicule();
    if(idtoStop == null) {
        activateVehicule(idVeh);
        return 0;
    } 
    //le mettre à 0
    desactiveVehicule(idtoStop);
    activateVehicule(idVeh)

}



function getAllreadySellectVehicule() {
    let request = new XMLHttpRequest();  
    request.open("GET",apiPath + "/vehicules/get/getCarsByUsed.php?id="+ id,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let restult = JSON.parse(request.responseText);
                    if(restult.hasOwnProperty("message"))
                        return null;
                    console.log(restult);
                    result = String(restult[0]["id"]);
                    console.log(result);
                    return restult;
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}


function activateVehicule(idVehiculetoSet) {
    let zone = document.getElementById("zoneMax").value;
    zone = parseInt(zone,10);
    let jsonToSend = {
        employ:1,
        id:idVehiculetoSet
    };
    let request = new XMLHttpRequest();  
    request.open("POST",apiPath + "/vehicules/post/update.php",true); 
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
    request.send(JSON.stringify(jsonToSend));
}


function desactiveVehicule(idtodesactice) {
    let jsonToSend = {
        employ:0,
        id:idtodesactice
    };
    let request = new XMLHttpRequest();  
    request.open("POST",apiPath + "/vehicules/post/update.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log("désactive");
                    console.log(ObjJson);
                    return true;
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}


function assigneTo(idColis) {
    let jsonToSend = {
        id:idColis,
        idDelivery:id
    };
    let request = new XMLHttpRequest();  
    request.open("POST",apiPath + "/colis/post/update.php",true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                        let  ObjJson = JSON.parse(request.responseText);
                        console.log(ObjJson);
                        baliseToFilled.innerHTML = "";
                        let h1 = document.createElement("h1");
                        h1.innerHTML = "liste des colis à saisir";
                        baliseToFilled.appendChild(h1);
                        ObjJson.forEach(element=>{
                            let nwLine = document.createElement("p");
                            nwLine.setAttribute('onclick','assigneTo(' + String(element["id"]) + ');');
                            nwLine.innerHTML = element["adresse"];
                            baliseToFilled.appendChild(nwLine);
                        });
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send();
}



function deliveryGenerator(){
    let listColis  = getColist(depotGlobal);
    let idActiveCar = getAllreadySellectVehicule();
    let car = getCarBYIDForDelivery(idActiveCar);
    console.log(" data");
    console.log(car);
}