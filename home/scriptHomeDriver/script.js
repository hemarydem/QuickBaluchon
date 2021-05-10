/* FILE EDITE BY:
 *                 - YANIS TAGRI
 *                 - PEROCHON LÉO
 *                 - HAMED Rémy
 * FILE purpose:
 *  All fuction to help the driver to interact with his profile
 * 
 */


let divTOremov= document.getElementById("di");
let id = parseInt(divTOremov.innerHTML);
let containerLeft = document.getElementById("leftcont");
let containerCenter = document.getElementById("centerCont");
//let containerLeft = document.getElementById("leftcont");
document.getElementById("app").removeChild(divTOremov);

getCarsListByDriverId();

/*
 *  getCarsListByDriverId
 *
 *  arg id of an element
 *  
 * get the list of cars and data of drivers car by calling api
 * 
 * return a void
 * */

function getCarsListByDriverId() {
    let ObjJson;
    let request = new XMLHttpRequest();  
    request.open("GET","http://152.228.163.174/api/QuickBaluchon/vehicules/get/getCarsByUserId.php?id="+ id,true); 
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    ObjJson = JSON.parse(request.responseText);
                    if(ObjJson.hasOwnProperty("message")) {
                        containerLeft.innerHTML = ObjJson["message"];
                    } else {
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
    request.open("GET","http://localhost:8888/api/vehicules/get/vehicule.php?id="+ idCar,true); 
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
        ajaxSendPost(getData(),"http://152.228.163.174/api/QuickBaluchon//vehicules/post/creat.php");
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
                    
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}