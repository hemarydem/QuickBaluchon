
let div = document.getElementById("div");

function updateUserActive(id, active) {
  let jsonToSend
  if (active == 0) {
    jsonToSend = {
        "id":id,
        "active":1
    };
  }else if (active == 1) {
    jsonToSend = {
        "id":id,
        "active":0
    };
  }
  let request = new XMLHttpRequest();
  request.open("POST",'https://quickbaluchonservice.site/api/QuickBaluchon/users/post/update.php',true);
  request.onreadystatechange = function() {
      if(request.readyState == 4) {
              if(request.status == 200) {
                  let ObjJson = JSON.parse(request.responseText);
                  console.log(ObjJson);
                  if(ObjJson.hasOwnProperty("message")) {
                      console.log("error update not send");
                  } else {
                      listInfosUser(id);
                  }
          } else {
              alert("Error: returned status code " + request.status + " " + request.statusText);
          }
      }
  }
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.send(JSON.stringify(jsonToSend));
}

function sendMailConfirmation(resId,resMail) {
    let jsonToSend = {
        "id":resId,
        "mail":resMail
    };
    let request = new XMLHttpRequest();
    request.open("POST",'https://quickbaluchonservice.site/QuickBaluchon/utls/mail.php',true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error mail not send");
                    } else {
                        setTokenOnUserprofile(resId,ObjJson["token"]);
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}

function setTokenOnUserprofile(resId,resToken) {
    let jsonToSend = {
        "id":resId,
        "tokenEmail":resToken
    };
    let request = new XMLHttpRequest();
    request.open("POST","https://quickbaluchonservice.site/api/QuickBaluchon/users/post/update.php",true);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
                if(request.status == 200) {
                    let ObjJson = JSON.parse(request.responseText);
                    console.log(ObjJson);
                    if(ObjJson.hasOwnProperty("message")) {
                        console.log("error maj profil user");
                    } else {
                        console.log("pas d'erreur");
                    }
            } else {
                alert("Error: returned status code " + request.status + " " + request.statusText);
            }
        }
    }
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(JSON.stringify(jsonToSend));
}

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

function validate() {
    let canContainSpace = false;
    let mustNotContainSpace = true;
    let OnlyNumber = true;
    let OnlyNumberNot = false;
    let OnlyLetter = true;
    let OnlyLetterNot = false;

    let allowedSend = [true,true,true,true,true,true,true];

    allowedSend[0] = checkInput("nom",50,OnlyNumberNot,OnlyLetter,canContainSpace);

    allowedSend [1]= checkInput("prenom",50,OnlyNumberNot,OnlyLetter,canContainSpace);

    allowedSend[2] = checkInput("password",255,OnlyNumberNot,OnlyLetterNot,mustNotContainSpace);

    allowedSend[3] = checkInput("adresse",255,OnlyNumberNot,OnlyLetterNot,canContainSpace);

    allowedSend[4] = checkInput("tel",10,OnlyNumber,OnlyLetterNot,mustNotContainSpace);

    allowedSend[5] = checkInput("mail",255,OnlyNumberNot,OnlyLetterNot,mustNotContainSpace);

    console.log(allowedSend);
    let block = 0;
    allowedSend.forEach(element => {            // check if each input was validate
        if(element == false){
            console.log("envoie pas");
            alert("Erreur dans les informations entrées")
            block = 1;
        }
    });
    if(block == 0) {
        executeCreateAdmin(createAdmin());
    }
    console.log(" FIN");
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

function executeCreateAdmin(data) {
  let ObjJson;
  let jsonToSend = {
      nom:data[0],
      prenom:data[1],
      mail:data[2],
      adresse:data[3],
      numSiret:data[4],
      password:data[5],
      tel:data[6],
      statut:data[7],
      driverLicence:data[8],
      busy:data[9],
      zoneMaxDef:data[10]
  };
  let request = new XMLHttpRequest();
  request.open("POST","https://quickbaluchonservice.site/api/QuickBaluchon/users/post/creat.php/users/post/creat.php",true);
  request.onreadystatechange = function() {
      if(request.readyState == 4) {
              if(request.status == 200) {
                ObjJson = JSON.parse(request.responseText);
                if(ObjJson.hasOwnProperty("message")) {
                        alert(ObjJson["message"]);
                    } else {
                        alert("Création du nouvel administrateur réussie");
                        sendMailConfirmation(ObjJson["id"], ObjJson["mail"]);
                        gestionMenu(5);
                    }

          } else {
              alert("Error: returned status code " + request.status + " " + request.statusText);
          }
      }
  }
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.send(JSON.stringify(jsonToSend));
}

function createAdmin() {
  let nom = document.getElementById("nom").value;
  let prenom = document.getElementById("prenom").value;
  let mail = document.getElementById("mail").value;
  let adresse = document.getElementById("adresse").value;
  let password= document.getElementById("password").value;
  let confirmPassword= document.getElementById("confirmPassword").value;
  let tel = document.getElementById("tel").value;
  let statut = "2";
  let numSiret = "0";
  let driverLicence = "0";
  let busy = "0";
  let zoneMaxDef = "0";

  if (confirmPassword == password) {
    nom = nom.trim();
    prenom = prenom.trim();
    mail = mail.trim();
    adresse = adresse.trim();
    password = password.trim();
    tel = tel.trim();

    mail = mail.replace(/\s/, '');
    tel = tel.replace(/\s/, '');

    let array = [nom,prenom,mail,adresse,numSiret,password,tel,statut,driverLicence,busy,zoneMaxDef];
    return array;
  }else {
    alert("Les 2 mots de passe ne sont pas identiques");
  }


}

function createAdminForm() {
  let newDiv = document.getElementById("section5");
  let divCreate = document.createElement('div');
  divCreate.setAttribute("class", "col");
  divCreate.setAttribute("id", "divCreate");
  newDiv.appendChild(divCreate);
  let h1 = document.createElement('h1');
  h1.innerHTML = "Créer un nouvel administrateur";
  divCreate.appendChild(h1);

  let input1 = document.createElement('input');
  divCreate.appendChild(input1);
  input1.setAttribute("id", "mail");
  input1.setAttribute("type", "text");
  input1.setAttribute("placeholder", "Mail");
  input1.setAttribute("oninput", "checkLen('mail',255)");
  let p1 = document.createElement('p');
  divCreate.appendChild(p1);
  p1.setAttribute("id", "limitmail");
  p1.innerHTML = "255/255";
  let p2 = document.createElement('p');
  divCreate.appendChild(p2);
  p2.setAttribute("id", "erromail");

  let input2 = document.createElement('input');
  divCreate.appendChild(input2);
  input2.setAttribute("id", "nom");
  input2.setAttribute("type", "text");
  input2.setAttribute("placeholder", "Nom");
  input2.setAttribute("oninput", "checkLen('nom',50)");
  let p3 = document.createElement('p');
  divCreate.appendChild(p3);
  p3.setAttribute("id", "limitnom");
  p3.innerHTML = "50/50";
  let p4 = document.createElement('p');
  divCreate.appendChild(p4);
  p4.setAttribute("id", "erronom");

  let input3 = document.createElement('input');
  divCreate.appendChild(input3);
  input3.setAttribute("id", "prenom");
  input3.setAttribute("type", "text");
  input3.setAttribute("placeholder", "Prénom");
  input3.setAttribute("oninput", "checkLen('prenom',50)");
  let p5 = document.createElement('p');
  divCreate.appendChild(p5);
  p5.setAttribute("id", "limitprenom");
  p5.innerHTML = "50/50";
  let p6 = document.createElement('p');
  divCreate.appendChild(p6);
  p6.setAttribute("id", "erroprenom");

  let input4 = document.createElement('input');
  divCreate.appendChild(input4);
  input4.setAttribute("id", "password");
  input4.setAttribute("type", "text");
  input4.setAttribute("placeholder", "Mot de passe");
  input4.setAttribute("oninput", "checkLen('password',255)");
  let p7 = document.createElement('p');
  divCreate.appendChild(p7);
  p7.setAttribute("id", "limitpassword");
  p7.innerHTML = "255/255";
  let p8 = document.createElement('p');
  divCreate.appendChild(p8);
  p8.setAttribute("id", "erropassword");

  let input5 = document.createElement('input');
  divCreate.appendChild(input5);
  input5.setAttribute("id", "confirmPassword");
  input5.setAttribute("type", "text");
  input5.setAttribute("placeholder", "Confirmer le mot de passe");
  input5.setAttribute("oninput", "checkLen('confirmPassword',255)");
  let p9 = document.createElement('p');
  divCreate.appendChild(p9);
  p9.setAttribute("id", "limitconfirmPassword");
  p9.innerHTML = "255/255";
  let p10 = document.createElement('p');
  divCreate.appendChild(p10);
  p10.setAttribute("id", "erroconfirmPassword");

  let input6 = document.createElement('input');
  divCreate.appendChild(input6);
  input6.setAttribute("id", "adresse");
  input6.setAttribute("type", "text");
  input6.setAttribute("placeholder", "Adresse");
  input6.setAttribute("oninput", "checkLen('adresse',255)");
  let p11 = document.createElement('p');
  divCreate.appendChild(p11);
  p11.setAttribute("id", "limitadresse");
  p11.innerHTML = "255/255";
  let p12 = document.createElement('p');
  divCreate.appendChild(p12);
  p12.setAttribute("id", "erroadresse");

  let input7 = document.createElement('input');
  divCreate.appendChild(input7);
  input7.setAttribute("id", "tel");
  input7.setAttribute("type", "text");
  input7.setAttribute("placeholder", "Numéro de téléphone");
  input7.setAttribute("oninput", "checkLen('tel',10)");
  let p13 = document.createElement('p');
  divCreate.appendChild(p13);
  p13.setAttribute("id", "limittel");
  p13.innerHTML = "10/10";
  let p14 = document.createElement('p');
  divCreate.appendChild(p14);
  p14.setAttribute("id", "errotel");

  let button = document.createElement('button');
  button.setAttribute("onclick", "validate()");
  button.innerHTML = "Créer";
  divCreate.appendChild(button);

}

function searchUserMail(statut) {
  let containerLeft = document.getElementById("result");
  containerLeft.innerHTML = "";

  let findMail = document.getElementById("search").value;
  findMail = String(findMail);

  console.log("search()");
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/users/get/list.php?limit=100000&offset=0&mail=" + findMail,true);
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
                      let th2 =  document.createElement("th");
                      let th3 =  document.createElement("th");
                      th1.innerHTML = "ID";
                      th2.innerHTML = "Nom";
                      th3.innerHTML = "Mail";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);
                      tr1.appendChild(th2);
                      tr1.appendChild(th3);


                      ObjJson.forEach(
                        element => {

                          if (statut == 1 && String(element["statut"]) == 1) {
                            let nwLine =  document.createElement("tr");
                            tabBase.appendChild(nwLine);
                            let td1 = document.createElement("td");
                            nwLine.appendChild(td1);
                            td1.innerHTML = String(element["id"]);
                            let td2 = document.createElement("td");
                            nwLine.appendChild(td2);
                            td2.innerHTML = String(element["nom"]);
                            let td3 = document.createElement("td");
                            nwLine.appendChild(td3);
                            let a1 = document.createElement("a");
                            td3.appendChild(a1);
                            a1.innerHTML = String(element["mail"]);
                            a1.setAttribute("onclick", "listInfosUser(" + String(element["id"]) + "," + String(element["statut"]) + ")");
                            a1.setAttribute("href", "#section" + String(element["id"]));
                          }else if (statut == 2 && String(element["statut"]) == 2) {
                            let nwLine =  document.createElement("tr");
                            tabBase.appendChild(nwLine);
                            let td1 = document.createElement("td");
                            nwLine.appendChild(td1);
                            td1.innerHTML = String(element["id"]);
                            let td2 = document.createElement("td");
                            nwLine.appendChild(td2);
                            td2.innerHTML = String(element["nom"]);
                            let td3 = document.createElement("td");
                            nwLine.appendChild(td3);
                            let a1 = document.createElement("a");
                            td3.appendChild(a1);
                            a1.innerHTML = String(element["mail"]);
                            a1.setAttribute("onclick", "listInfosUser(" + String(element["id"]) + "," + String(element["statut"]) + ")");
                            a1.setAttribute("href", "#section" + String(element["id"]));
                          }else if (statut == 3 && String(element["statut"]) == 3) {
                            let nwLine =  document.createElement("tr");
                            tabBase.appendChild(nwLine);
                            let td1 = document.createElement("td");
                            nwLine.appendChild(td1);
                            td1.innerHTML = String(element["id"]);
                            let td2 = document.createElement("td");
                            nwLine.appendChild(td2);
                            td2.innerHTML = String(element["nom"]);
                            let td3 = document.createElement("td");
                            nwLine.appendChild(td3);
                            let a1 = document.createElement("a");
                            td3.appendChild(a1);
                            a1.innerHTML = String(element["mail"]);
                            a1.setAttribute("onclick", "listInfosUser(" + String(element["id"]) + "," + String(element["statut"]) + ")");
                            a1.setAttribute("href", "#section" + String(element["id"]));
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

function searchColisMail() {
  let containerLeft = document.getElementById("result1");
  containerLeft.innerHTML = "";

  let findMail = document.getElementById("search1").value;
  findMail = String(findMail);

  console.log("search()");
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/list.php?limit=10000&offset=0&id=&recipientMail=" + findMail + "&sendingStatut&isPayed",true);
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
                    let th2 =  document.createElement("th");
                    let th3 =  document.createElement("th");
                    let th4 =  document.createElement("th");
                    th1.innerHTML = "ID";
                    th2.innerHTML = "Mail du destinataire";
                    th3.innerHTML = "Etat de livraison du colis";
                    th4.innerHTML = "Le colis est payé";
                    containerLeft.appendChild(tabBase);
                    tabBase.appendChild(tr1);
                    tr1.appendChild(th1);
                    tr1.appendChild(th2);
                    tr1.appendChild(th3);
                    tr1.appendChild(th4);


                    ObjJson.forEach(
                      element => {
                        let nwLine =  document.createElement("tr");
                        tabBase.appendChild(nwLine);
                        let td1 = document.createElement("td");
                        nwLine.appendChild(td1);
                        let a1 = document.createElement("a");
                        td1.appendChild(a1);
                        a1.innerHTML = String(element["id"]);
                        a1.setAttribute("onclick", 'listInfosColis("' + String(element["id"]) + '")');
                        a1.setAttribute("href", "#section" + String(element["id"]));
                        let td2 = document.createElement("td");
                        nwLine.appendChild(td2);
                        td2.innerHTML = String(element["recipientMail"]);
                        let td3 = document.createElement("td");
                        nwLine.appendChild(td3);
                        if (String(element["sendingStatut"]) == "0") {
                          td3.innerHTML = "Le colis n'est pas encore au dépot";
                        }else if (String(element["sendingStatut"]) == "1") {
                          td3.innerHTML = "Le colis est au dépot";
                        }else if (String(element["sendingStatut"]) == "2") {
                          td3.innerHTML = "Le colis est en cours de livraison";
                        }else if (String(element["sendingStatut"]) == "3") {
                          td3.innerHTML = "Le colis est livré";
                        }
                        let td4 = document.createElement("td");
                        nwLine.appendChild(td4);
                        if (String(element["isPayed"]) == "0") {
                          td4.innerHTML = "Payé";
                        }else if (String(element["isPayed"]) == "1") {
                          td4.innerHTML = "A payer";
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

function searchColisId() {
  let containerLeft = document.getElementById("result2");
  containerLeft.innerHTML = "";

  let findId = document.getElementById("search2").value;
  findId = String(findId);

  console.log("search()");
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/list.php?limit=10000&offset=0&id=" + findId + "&recipientMail&sendingStatut&isPayed",true);
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
                    let th2 =  document.createElement("th");
                    let th3 =  document.createElement("th");
                    let th4 =  document.createElement("th");
                    th1.innerHTML = "ID";
                    th2.innerHTML = "Mail du destinataire";
                    th3.innerHTML = "Etat de livraison du colis";
                    th4.innerHTML = "Le colis est payé";
                    containerLeft.appendChild(tabBase);
                    tabBase.appendChild(tr1);
                    tr1.appendChild(th1);
                    tr1.appendChild(th2);
                    tr1.appendChild(th3);
                    tr1.appendChild(th4);


                    ObjJson.forEach(
                      element => {
                        let nwLine =  document.createElement("tr");
                        tabBase.appendChild(nwLine);
                        let td1 = document.createElement("td");
                        nwLine.appendChild(td1);
                        let a1 = document.createElement("a");
                        td1.appendChild(a1);
                        a1.innerHTML = String(element["id"]);
                        a1.setAttribute("onclick", 'listInfosColis("' + String(element["id"]) + '")');
                        a1.setAttribute("href", "#section" + String(element["id"]));
                        let td2 = document.createElement("td");
                        nwLine.appendChild(td2);
                        td2.innerHTML = String(element["recipientMail"]);
                        let td3 = document.createElement("td");
                        nwLine.appendChild(td3);
                        if (String(element["sendingStatut"]) == "0") {
                          td3.innerHTML = "Le colis n'est pas encore au dépot";
                        }else if (String(element["sendingStatut"]) == "1") {
                          td3.innerHTML = "Le colis est au dépot";
                        }else if (String(element["sendingStatut"]) == "2") {
                          td3.innerHTML = "Le colis est en cours de livraison";
                        }else if (String(element["sendingStatut"]) == "3") {
                          td3.innerHTML = "Le colis est livré";
                        }
                        let td4 = document.createElement("td");
                        nwLine.appendChild(td4);
                        if (String(element["isPayed"]) == "0") {
                          td4.innerHTML = "Payé";
                        }else if (String(element["isPayed"]) == "1") {
                          td4.innerHTML = "A payer";
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

function searchRecipientMail() {
  let containerLeft = document.getElementById("result");
  containerLeft.innerHTML = "";

  let findMail = document.getElementById("search").value;
  findMail = String(findMail);

  console.log("search()");
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/recipients/get/list.php?mail=" + findMail + "&limit=10000&offset=0&id",true);
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
                    th1.innerHTML = "liste de tous les mails des clients";
                    containerLeft.appendChild(tabBase);
                    tabBase.appendChild(tr1);
                    tr1.appendChild(th1);


                    ObjJson.forEach(
                      element => {
                        let nwLine =  document.createElement("tr");
                        tabBase.appendChild(nwLine);
                        let td1 = document.createElement("td");
                        nwLine.appendChild(td1);
                        let a1 = document.createElement("a");
                        td1.appendChild(a1);
                        a1.innerHTML = String(element["mail"]);
                        a1.setAttribute("onclick", 'listInfosRecipient("' + String(element["id"]) + '")');
                        a1.setAttribute("href", "#section" + String(element["id"]));
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

function searchVehiculeImmatriculation() {
  let containerLeft = document.getElementById("result");
  containerLeft.innerHTML = "";

  let findImm = document.getElementById("search").value;
  findImm = String(findImm);

  console.log("search()");
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/list.php?offset=0&imatriculation=" + findImm + "&limit=1000000000",true);
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
                    th1.innerHTML = "Immatriculation";
                    containerLeft.appendChild(tabBase);
                    tabBase.appendChild(tr1);
                    tr1.appendChild(th1);


                    ObjJson.forEach(
                      element => {
                        let nwLine =  document.createElement("tr");
                        tabBase.appendChild(nwLine);
                        let td1 = document.createElement("td");
                        nwLine.appendChild(td1);
                        let a1 = document.createElement("a");
                        td1.appendChild(a1);
                        a1.innerHTML = String(element["imatriculation"]);
                        a1.setAttribute("onclick", 'listInfosVehicule("' + String(element["id"]) + '")');
                        a1.setAttribute("href", "#section" + String(element["id"]));
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

function searchUser(statut) {
  div.innerHTML = "";
  let h1 = document.createElement('h1');
  div.appendChild(h1);

  if (statut == 1) {
    h1.innerHTML = "Faire une recherche par le mail d'un livreur";
  }else if (statut == 2) {
  h1.innerHTML = "Faire une recherche par le mail d'un administrateurs";
  }else if (statut == 3) {
  h1.innerHTML = "Faire une recherche par le mail d'un clients";
  }

  let input = document.createElement('input');
  div.appendChild(input);
  input.setAttribute("id", "search");
  input.setAttribute("type", "text");
  input.setAttribute("placeholder", "mail");

  let button = document.createElement('button');
  div.appendChild(button);
  button.setAttribute("type", "button");
  button.setAttribute("onclick", "searchUserMail(" + statut + ")");
  button.innerHTML = "Rechercher";

  let newDiv = document.createElement('div');
  div.appendChild(newDiv);
  newDiv.setAttribute("id", "result");
}

function searchColis(type) {
  div.innerHTML = "";
  if (type == 1) {
    let h1a = document.createElement('h1');
    div.appendChild(h1a);
    h1a.innerHTML = "Faire une recherche par le mail d'un colis";

    let input1 = document.createElement('input');
    div.appendChild(input1);
    input1.setAttribute("id", "search1");
    input1.setAttribute("type", "text");
    input1.setAttribute("placeholder", "mail");

    let button1 = document.createElement('button');
    div.appendChild(button1);
    button1.setAttribute("type", "button");
    button1.setAttribute("onclick", "searchColisMail()");
    button1.innerHTML = "Rechercher";

    let newDiv1 = document.createElement('div');
    div.appendChild(newDiv1);
    newDiv1.setAttribute("id", "result1");
  }else if (type == 2) {
    let h1b = document.createElement('h1');
    div.appendChild(h1b);
    h1b.innerHTML = "Faire une recherche par l'id d'un colis";

    let input2 = document.createElement('input');
    div.appendChild(input2);
    input2.setAttribute("id", "search2");
    input2.setAttribute("type", "text");
    input2.setAttribute("placeholder", "id");

    let button2 = document.createElement('button');
    div.appendChild(button2);
    button2.setAttribute("type", "button");
    button2.setAttribute("onclick", "searchColisId()");
    button2.innerHTML = "Rechercher";

    let newDiv2 = document.createElement('div');
    div.appendChild(newDiv2);
    newDiv2.setAttribute("id", "result2");
  }
}

function searchRecipient() {
  div.innerHTML = "";
  let h1 = document.createElement('h1');
  div.appendChild(h1);
  h1.innerHTML = "Faire une recherche par le mail d'un particulier";

  let input = document.createElement('input');
  div.appendChild(input);
  input.setAttribute("id", "search");
  input.setAttribute("type", "text");
  input.setAttribute("placeholder", "mail");

  let button = document.createElement('button');
  div.appendChild(button);
  button.setAttribute("type", "button");
  button.setAttribute("onclick", "searchRecipientMail()");
  button.innerHTML = "Rechercher";

  let newDiv = document.createElement('div');
  div.appendChild(newDiv);
  newDiv.setAttribute("id", "result");
}

function searchVehicule() {
  div.innerHTML = "";
  let h1 = document.createElement('h1');
  div.appendChild(h1);
  h1.innerHTML = "Faire une recherche par le mail d'un véhicule";

  let input = document.createElement('input');
  div.appendChild(input);
  input.setAttribute("id", "search");
  input.setAttribute("type", "text");
  input.setAttribute("placeholder", "mail");

  let button = document.createElement('button');
  div.appendChild(button);
  button.setAttribute("type", "button");
  button.setAttribute("onclick", "searchVehiculeImmatriculation()");
  button.innerHTML = "Rechercher";

  let newDiv = document.createElement('div');
  div.appendChild(newDiv);
  newDiv.setAttribute("id", "result");
}

function removeUser(id, statut) {
  let ObjJson;
  let request = new XMLHttpRequest();
  request2 = "https://quickbaluchonservice.site/api/QuickBaluchon/users/delete/delete.php?id=" + id;
  request.open("GET",request2,true);
  console.log(request2);
  request.onreadystatechange = function() {
      if(request.readyState == 4) {
              if(request.status == 200) {
                  ObjJson = JSON.parse(request.responseText);
                  if(ObjJson.hasOwnProperty("message")) {
                      containerLeft.innerHTML = ObjJson["message"];
                  } else {
                    if (String(ObjJson["success"]) == 1) {
                      div.innerHTML = "";
                      alert("La suppression de l'utilisateur est réussie");
                      if (statut == 1) {
                        gestionMenu(2);
                      }else if (statut == 2) {
                        gestionMenu(5);
                      }else if (statut == 3) {
                        gestionMenu(1);
                      }
                    }else if (String(ObjJson["success"]) == 0) {
                      alert("La suppression à échouer");
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

function removeColis(id) {
  let ObjJson;
  let request = new XMLHttpRequest();
  request2 = "https://quickbaluchonservice.site/api/QuickBaluchon/colis/delete/delete.php?id=" + id;
  request.open("GET",request2,true);
  console.log(request2);
  request.onreadystatechange = function() {
      if(request.readyState == 4) {
              if(request.status == 200) {
                  ObjJson = JSON.parse(request.responseText);
                  if(ObjJson.hasOwnProperty("message")) {
                      containerLeft.innerHTML = ObjJson["message"];
                  } else {
                    if (String(ObjJson["success"]) == 1) {
                      div.innerHTML = "";
                      alert("La suppression du colis est réussie");
                      getListColis(1);
                    }else if (String(ObjJson["success"]) == 0) {
                      alert("La suppression à échouer");
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

function getListUserDriverLicence() {
  let containerLeft = document.getElementById("containerLeft");
  containerLeft.innerHTML = "";
  let h2 = document.createElement('h2');
  h2.innerHTML = "Liste de tous les livreurs n'ayant pas de permis validé";
  containerLeft.appendChild(h2);
  let button = document.createElement('button');
  button.setAttribute("onclick", "getListUser(4)");
  button.innerHTML = "Voir la liste des livreurs qui sont dans l'attente de validation du permis";
  containerLeft.appendChild(button);
  let ObjJson;
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/users/get/list.php?limit=100000&offset=0&statut=1&driverLicence=0",true);
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
                      let th2 =  document.createElement("th");
                      let th3 =  document.createElement("th");
                      th1.innerHTML = "ID";
                      th2.innerHTML = "Nom";
                      th3.innerHTML = "Mail";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);
                      tr1.appendChild(th2);
                      tr1.appendChild(th3);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          td1.innerHTML = String(element["id"]);
                          let td2 = document.createElement("td");
                          nwLine.appendChild(td2);
                          td2.innerHTML = String(element["nom"]);
                          let td3 = document.createElement("td");
                          nwLine.appendChild(td3);
                          let a1 = document.createElement("a");
                          td3.appendChild(a1);
                          a1.innerHTML = String(element["mail"]);
                          a1.setAttribute("onclick", "listInfosUser(" + String(element["id"]) + ", 1)");
                          a1.setAttribute("href", "#section" + String(element["id"]));
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

function getListColisByIdRecipient(idRecipient) {
  let containerLeft = document.getElementById("section" + idRecipient);
  let ObjJson;
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/getValue.php?idRecipient=" + idRecipient,true);
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
                      let th2 =  document.createElement("th");
                      let th3 =  document.createElement("th");
                      th1.innerHTML = "ID";
                      th2.innerHTML = "Mail du destinataire";
                      th3.innerHTML = "Etat de livraison du colis";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);
                      tr1.appendChild(th2);
                      tr1.appendChild(th3);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          let a1 = document.createElement("a");
                          td1.appendChild(a1);
                          a1.innerHTML = String(element["id"]);
                          a1.setAttribute("onclick", 'listInfosColis("' + String(element["id"]) + '")');
                          a1.setAttribute("href", "#section" + String(element["id"]));
                          let td2 = document.createElement("td");
                          nwLine.appendChild(td2);
                          td2.innerHTML = String(element["recipientMail"]);
                          let td3 = document.createElement("td");
                          nwLine.appendChild(td3);
                          if (String(element["sendingStatut"]) == "0") {
                            td3.innerHTML = "Le colis n'est pas encore au dépot";
                          }else if (String(element["sendingStatut"]) == "1") {
                            td3.innerHTML = "Le colis est au dépot";
                          }else if (String(element["sendingStatut"]) == "2") {
                            td3.innerHTML = "Le colis est en cours de livraison";
                          }else if (String(element["sendingStatut"]) == "3") {
                            td3.innerHTML = "Le colis est livré";
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

function getListColisByIdUser(idUser) {
  let containerLeft = document.getElementById("section" + idUser);
  let ObjJson;
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/list.php?limit=10&offset=0&idUser=" + idUser + "&id&recipientMail&sendingStatut&isPayed",true);
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
                      let th2 =  document.createElement("th");
                      let th3 =  document.createElement("th");
                      let th4 =  document.createElement("th");
                      th1.innerHTML = "ID";
                      th2.innerHTML = "Mail du destinataire";
                      th3.innerHTML = "Etat de livraison du colis";
                      th4.innerHTML = "Le colis est payé";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);
                      tr1.appendChild(th2);
                      tr1.appendChild(th3);
                      tr1.appendChild(th4);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          let a1 = document.createElement("a");
                          td1.appendChild(a1);
                          a1.innerHTML = String(element["id"]);
                          a1.setAttribute("onclick", 'listInfosColis("' + String(element["id"]) + '")');
                          a1.setAttribute("href", "#section" + String(element["id"]));
                          let td2 = document.createElement("td");
                          nwLine.appendChild(td2);
                          td2.innerHTML = String(element["recipientMail"]);
                          let td3 = document.createElement("td");
                          nwLine.appendChild(td3);
                          if (String(element["sendingStatut"]) == "0") {
                            td3.innerHTML = "Le colis n'est pas encore au dépot";
                          }else if (String(element["sendingStatut"]) == "1") {
                            td3.innerHTML = "Le colis est au dépot";
                          }else if (String(element["sendingStatut"]) == "2") {
                            td3.innerHTML = "Le colis est en cours de livraison";
                          }else if (String(element["sendingStatut"]) == "3") {
                            td3.innerHTML = "Le colis est livré";
                          }
                          let td4 = document.createElement("td");
                          nwLine.appendChild(td4);
                          if (String(element["isPayed"]) == "0") {
                            td4.innerHTML = "Payé";
                          }else if (String(element["isPayed"]) == "1") {
                            td4.innerHTML = "A payer";
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

function getListColisBySendingStatut(sendingStatut) {
  let containerLeft = document.getElementById("containerLeft");
  containerLeft.innerHTML = "";

  let button = document.createElement('button');
  button.setAttribute("onclick", "getListColis(0)");
  button.innerHTML = "Liste de tous les colis";
  containerLeft.appendChild(button);

  if (sendingStatut == 0) {
    let h2 = document.createElement('h2');
    h2.innerHTML = "Liste des colis qui ne sont pas encore au dépot";
    containerLeft.appendChild(h2);
  }else if (sendingStatut == 1) {
    let h2 = document.createElement('h2');
    h2.innerHTML = "Liste des colis qui sont au dépot";
    containerLeft.appendChild(h2);
  }else if (sendingStatut == 2) {
    let h2 = document.createElement('h2');
    h2.innerHTML = "Liste des colis qui sont en cours de livraison";
    containerLeft.appendChild(h2);
  }else if (sendingStatut == 3) {
    let h2 = document.createElement('h2');
    h2.innerHTML = "Liste des colis livrés";
    containerLeft.appendChild(h2);
  }

  let ObjJson;
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/list.php?limit=10&offset=0&sendingStatut=" + sendingStatut + "&id&recipientMail&isPayed",true);
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
                      let th2 =  document.createElement("th");
                      let th3 =  document.createElement("th");
                      let th4 =  document.createElement("th");
                      th1.innerHTML = "ID";
                      th2.innerHTML = "Mail du destinataire";
                      th3.innerHTML = "Etat de livraison du colis";
                      th4.innerHTML = "Le colis est payé";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);
                      tr1.appendChild(th2);
                      tr1.appendChild(th3);
                      tr1.appendChild(th4);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          let a1 = document.createElement("a");
                          td1.appendChild(a1);
                          a1.innerHTML = String(element["id"]);
                          a1.setAttribute("onclick", 'listInfosColis("' + String(element["id"]) + '")');
                          a1.setAttribute("href", "#section" + String(element["id"]));
                          let td2 = document.createElement("td");
                          nwLine.appendChild(td2);
                          td2.innerHTML = String(element["recipientMail"]);
                          let td3 = document.createElement("td");
                          nwLine.appendChild(td3);
                          if (String(element["sendingStatut"]) == "0") {
                            td3.innerHTML = "Le colis n'est pas encore au dépot";
                          }else if (String(element["sendingStatut"]) == "1") {
                            td3.innerHTML = "Le colis est au dépot";
                          }else if (String(element["sendingStatut"]) == "2") {
                            td3.innerHTML = "Le colis est en cours de livraison";
                          }else if (String(element["sendingStatut"]) == "3") {
                            td3.innerHTML = "Le colis est livré";
                          }
                          let td4 = document.createElement("td");
                          nwLine.appendChild(td4);
                          if (String(element["isPayed"]) == "0") {
                            td4.innerHTML = "Payé";
                          }else if (String(element["isPayed"]) == "1") {
                            td4.innerHTML = "A payer";
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
//
function getListColisByIsPayed(isPayed) {
  let containerLeft = document.getElementById("containerLeft");
  containerLeft.innerHTML = "";

  let button = document.createElement('button');
  button.setAttribute("onclick", "getListColis(0)");
  button.innerHTML = "Liste de tous les colis";
  containerLeft.appendChild(button);

  if (isPayed == 0) {
    let h2 = document.createElement('h2');
    h2.innerHTML = "Liste des colis non payés";
    containerLeft.appendChild(h2);
  }else if (isPayed == 1) {
    let h2 = document.createElement('h2');
    h2.innerHTML = "Liste des colis payés";
    containerLeft.appendChild(h2);
  }

  let ObjJson;
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/list.php?limit=10000&offset=0&id=&recipientMail=&sendingStatut&isPayed=" + isPayed,true);
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
                      let th2 =  document.createElement("th");
                      let th3 =  document.createElement("th");
                      th1.innerHTML = "ID";
                      th2.innerHTML = "Mail du destinataire";
                      th3.innerHTML = "Etat de livraison du colis";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);
                      tr1.appendChild(th2);
                      tr1.appendChild(th3);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          let a1 = document.createElement("a");
                          td1.appendChild(a1);
                          a1.innerHTML = String(element["id"]);
                          a1.setAttribute("onclick", 'listInfosColis("' + String(element["id"]) + '")');
                          a1.setAttribute("href", "#section" + String(element["id"]));
                          let td2 = document.createElement("td");
                          nwLine.appendChild(td2);
                          td2.innerHTML = String(element["recipientMail"]);
                          let td3 = document.createElement("td");
                          nwLine.appendChild(td3);
                          if (String(element["sendingStatut"]) == "0") {
                            td3.innerHTML = "Le colis n'est pas encore au dépot";
                          }else if (String(element["sendingStatut"]) == "1") {
                            td3.innerHTML = "Le colis est au dépot";
                          }else if (String(element["sendingStatut"]) == "2") {
                            td3.innerHTML = "Le colis est en cours de livraison";
                          }else if (String(element["sendingStatut"]) == "3") {
                            td3.innerHTML = "Le colis est livré";
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

function listInfosUser (id) {
  div.innerHTML = "";
  let containerLeft = document.createElement('div');
  containerLeft.setAttribute("id", "section" + id);
  div.appendChild(containerLeft);
  let ObjJson;
  let request = new XMLHttpRequest();
  request2 = "https://quickbaluchonservice.site/api/QuickBaluchon/users/get/user.php?id=" + id;
  request.open("GET",request2,true);
  console.log(request2);
  request.onreadystatechange = function() {
      if(request.readyState == 4) {
              if(request.status == 200) {
                  ObjJson = JSON.parse(request.responseText);
                  if(ObjJson.hasOwnProperty("message")) {
                      containerLeft.innerHTML = ObjJson["message"];
                  } else {
                      let h1 = document.createElement("h1");
                      containerLeft.appendChild(h1);
                      h1.innerHTML = "Fiche de " + String(ObjJson["nom"]) + " " + String(ObjJson["prenom"]);
                      let p1 = document.createElement("p");
                      containerLeft.appendChild(p1);
                      p1.innerHTML = "Mail : " + String(ObjJson["mail"]) + "<br>" + "Adresse : " + String(ObjJson["adresse"]) + "<br>" + "Numéro de téléphone : " + String(ObjJson["tel"]);
                      let p2 = document.createElement("p");

                      if (String(ObjJson["statut"]) == "3") {
                        containerLeft.appendChild(p2);
                        p2.innerHTML = "Numéro de SIRET : " + String(ObjJson["numSiret"]);
                        getListColisByIdUser(id);
                      }else if (String(ObjJson["statut"]) == "1") {
                        if (String(ObjJson["driverLicence"]) == "1") {
                          containerLeft.appendChild(p2);
                          p2.innerHTML = "Le permis a été validé<br>La zone maximum défini par le livreur est de " + String(ObjJson["zoneMaxDef"]) + " km";
                          let p3 = document.createElement("p");
                          if (String(ObjJson["busy"]) == "0") {
                            containerLeft.appendChild(p3);
                            p3.innerHTML = "Le livreur n'a pas de livraison en cours";
                          }else if (String(ObjJson["busy"]) == "1"){
                            containerLeft.appendChild(p3);
                            p3.innerHTML = "Le livreur a une ou des livraisons en cours";
                          }
                        }else if (String(ObjJson["driverLicence"]) == "0"){
                        containerLeft.appendChild(p2);
                        p2.innerHTML = "Le permis n'est pas validé";
                        let p3 = document.createElement("p");
                      }
                    }
                    let button = document.createElement("button");
                    button.innerHTML = "Supprimer l'utilisateur";
                    button.setAttribute("onclick", "removeUser(" + id + "," + String(ObjJson["statut"]) + ")");
                    containerLeft.appendChild(button);
                    let button1 = document.createElement("button");
                    if (String(ObjJson["active"]) == 1) {
                      button1.innerHTML = "Bloquer";
                      button1.setAttribute("onclick", "updateUserActive(" + id + ",1)");
                      containerLeft.appendChild(button1);
                    }else {
                      button1.innerHTML = "Débloquer";
                      button1.setAttribute("onclick", "updateUserActive(" + id + ",0)");
                      containerLeft.appendChild(button1);
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

function listInfosColis(id) {
  div.innerHTML = "";
  let containerLeft = document.createElement('div');
  containerLeft.setAttribute("id", "section" + id);
  div.appendChild(containerLeft);
  let ObjJson;
  let request = new XMLHttpRequest();
  request2 = "https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/colis.php?id=" + id;
  request.open("GET",request2,true);
  console.log(request2);
  request.onreadystatechange = function() {
      if(request.readyState == 4) {
              if(request.status == 200) {
                  ObjJson = JSON.parse(request.responseText);
                  if(ObjJson.hasOwnProperty("message")) {
                      containerLeft.innerHTML = ObjJson["message"];
                  } else {
                      let h1 = document.createElement("h1");
                      containerLeft.appendChild(h1);
                      h1.innerHTML = "Fiche du Colis n°" + String(ObjJson["id"]);
                      let p1 = document.createElement("p");
                      containerLeft.appendChild(p1);
                      p1.innerHTML = "Adresse de livraison : " + String(ObjJson["adresse"]);
                      let p2 = document.createElement("p");
                      containerLeft.appendChild(p2);
                      p2.innerHTML = "Code postal de livraison : " + String(ObjJson["codePostale"]);
                      let p3 = document.createElement("p");
                      containerLeft.appendChild(p3);
                      p3.innerHTML = "Mail du destinataire : " + String(ObjJson["recipientMail"]);
                      let p4 = document.createElement("p");
                      containerLeft.appendChild(p4);
                      p4.innerHTML = "Prix : " + String(ObjJson["price"]);
                      let button1 = document.createElement("button");
                      button1.setAttribute("onclick", "removeColis(" + id + ")");
                      button1.innerHTML = "Supprimer le colis";
                      containerLeft.appendChild(button1);

                  }
                } else {
                    alert("Error: returned status code " + request.status + " " + request.statusText);
                }
            }
        }
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send();
}

function listInfosRecipient (id) {
  div.innerHTML = "";
  let containerLeft = document.createElement('div');
  containerLeft.setAttribute("id", "section" + id);
  div.appendChild(containerLeft);
  let ObjJson;
  let request = new XMLHttpRequest();
  request2 = "https://quickbaluchonservice.site/api/QuickBaluchon/recipients/get/recipient.php?id=" + id;
  request.open("GET",request2,true);
  console.log(request2);
  request.onreadystatechange = function() {
      if(request.readyState == 4) {
              if(request.status == 200) {
                  ObjJson = JSON.parse(request.responseText);
                  if(ObjJson.hasOwnProperty("message")) {
                      containerLeft.innerHTML = ObjJson["message"];
                  } else {
                      let h1 = document.createElement("h1");
                      containerLeft.appendChild(h1);
                      h1.innerHTML = "Fiche de " + String(ObjJson["nom"]) + " " + String(ObjJson["prenom"]);
                      let h2 = document.createElement("h2");
                      containerLeft.appendChild(h2);
                      h2.innerHTML = "Liste des colis de " + String(ObjJson["nom"]);
                      getListColisByIdRecipient(String(ObjJson["id"]));
                  }
                } else {
                    alert("Error: returned status code " + request.status + " " + request.statusText);
                }
            }
        }
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send();
}
//
function listInfosVehicule(id) {
  div.innerHTML = "";
  let containerLeft = document.createElement('div');
  containerLeft.setAttribute("id", "section" + id);
  div.appendChild(containerLeft);
  let ObjJson;
  let request = new XMLHttpRequest();
  request2 = "https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/vehicule.php?id=" + id;
  request.open("GET",request2,true);
  console.log(request2);
  request.onreadystatechange = function() {
      if(request.readyState == 4) {
              if(request.status == 200) {
                  ObjJson = JSON.parse(request.responseText);
                  if(ObjJson.hasOwnProperty("message")) {
                      containerLeft.innerHTML = ObjJson["message"];
                  } else {
                      let h1 = document.createElement("h1");
                      containerLeft.appendChild(h1);
                      h1.innerHTML = "Fiche du véhicule n°" + String(ObjJson["id"]);
                      let p1 = document.createElement("p");
                      containerLeft.appendChild(p1);
                      p1.innerHTML = "Immatriculation du véhicule : " + String(ObjJson["imatriculation"])
                                    + "<br>Volume maximum du véhicule : " + String(ObjJson["volumeMax"])
                                    + "<br>Poids maximum du véhicule : " + String(ObjJson["weightMax"])
                                    + "<br>Nombre de colis maximum du véhicule : " + String(ObjJson["nbColis"]);
                  }
                } else {
                    alert("Error: returned status code " + request.status + " " + request.statusText);
                }
            }
        }
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send();
}

function getListRecipient() {
  let containerLeft = document.getElementById("section3");
  let buttonSearch = document.createElement('button');
  buttonSearch.setAttribute("onclick", "searchRecipient()");
  buttonSearch.innerHTML = "Faire une recherche par le mail";
  containerLeft.appendChild(buttonSearch);
  let ObjJson;
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/recipients/get/list.php?limit=10000&offset=0",true);
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
                      th1.innerHTML = "liste de tous les mails des clients";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          let a1 = document.createElement("a");
                          td1.appendChild(a1);
                          a1.innerHTML = String(element["mail"]);
                          a1.setAttribute("onclick", 'listInfosRecipient("' + String(element["id"]) + '")');
                          a1.setAttribute("href", "#section" + String(element["id"]));
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

function getListUser(statut) {
  let containerLeft;
  if (statut == "1") {
    let newDiv = document.getElementById("section2");
    containerLeft = document.createElement('div');
    containerLeft.setAttribute("class", "col");
    containerLeft.setAttribute("id", "containerLeft");
    newDiv.appendChild(containerLeft);
    let h2 = document.createElement('h2');
    h2.innerHTML = "Liste de tous les livreurs";
    containerLeft.appendChild(h2);
    let button = document.createElement('button');
    button.setAttribute("onclick", "getListUserDriverLicence()");
    button.innerHTML = "Voir la liste des livreurs qui sont dans l'attente de validation du permis";
    containerLeft.appendChild(button);
  }else if (statut == "2") {
    containerLeft = document.getElementById("section5");
  }else if (statut == "3") {
    containerLeft = document.getElementById("section1");
  }else if (statut == "4") {
    containerLeft = document.getElementById("containerLeft");
    containerLeft.innerHTML = "";
    let h2 = document.createElement('h2');
    h2.innerHTML = "Liste de tous les livreurs";
    containerLeft.appendChild(h2);
    let button = document.createElement('button');
    button.setAttribute("onclick", "getListUserDriverLicence()");
    button.innerHTML = "Voir la liste des livreurs qui sont dans l'attente de validation du permis";
    containerLeft.appendChild(button);
    statut = "1";
  }

  let buttonSearch = document.createElement('button');
  buttonSearch.setAttribute("onclick", "searchUser(" + statut + ")");
  buttonSearch.innerHTML = "Faire une recherche par le mail";
  containerLeft.appendChild(buttonSearch);

  let ObjJson;
  let request = new XMLHttpRequest();

  if (statut == "1") {
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/users/get/list.php?limit=100000&offset=0&statut=1",true);
  }else if (statut == "2") {
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/users/get/list.php?limit=100000&offset=0&statut=2",true);
  }else if (statut == "3") {
    request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/users/get/list.php?limit=100000&offset=0&statut=3",true);
  }
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
                      let th2 =  document.createElement("th");
                      let th3 =  document.createElement("th");
                      th1.innerHTML = "ID";
                      th2.innerHTML = "Nom";
                      th3.innerHTML = "Mail";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);
                      tr1.appendChild(th2);
                      tr1.appendChild(th3);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          td1.innerHTML = String(element["id"]);
                          let td2 = document.createElement("td");
                          nwLine.appendChild(td2);
                          td2.innerHTML = String(element["nom"]);
                          let td3 = document.createElement("td");
                          nwLine.appendChild(td3);
                          let a1 = document.createElement("a");
                          td3.appendChild(a1);
                          a1.innerHTML = String(element["mail"]);
                          a1.setAttribute("onclick", "listInfosUser(" + String(element["id"]) + "," + statut + ")");
                          a1.setAttribute("href", "#section" + String(element["id"]));
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

function getListColis(value) {
  let newDiv;
  if (value == 0) {
    newDiv = document.getElementById("section4");
    newDiv.innerHTML = "";
  }else if (value == 1) {
    newDiv = document.createElement("div");
    newDiv.setAttribute("id", "section4");
    div.appendChild(newDiv);
  }

  let h1 = document.createElement('h1');
  h1.innerHTML = "Gestion des colis";
  newDiv.appendChild(h1);

  containerLeft = document.createElement('div');
  containerLeft.setAttribute("class", "col");
  containerLeft.setAttribute("id", "containerLeft");
  newDiv.appendChild(containerLeft);

  let button5 = document.createElement('button');
  button5.setAttribute("onclick", "getListColisByIsPayed(0)");
  button5.innerHTML = "Liste des colis non payés";
  containerLeft.appendChild(button5);
  let button6 = document.createElement('button');
  button6.setAttribute("onclick", "getListColisByIsPayed(1)");
  button6.innerHTML = "Liste des colis payés";
  containerLeft.appendChild(button6);

  let button1 = document.createElement('button');
  button1.setAttribute("onclick", "getListColisBySendingStatut(0)");
  button1.innerHTML = "Liste des colis qui ne sont pas encore au dépot";
  containerLeft.appendChild(button1);
  let button2 = document.createElement('button');
  button2.setAttribute("onclick", "getListColisBySendingStatut(1)");
  button2.innerHTML = "Liste des colis qui sont au dépot";
  containerLeft.appendChild(button2);
  let button3 = document.createElement('button');
  button3.setAttribute("onclick", "getListColisBySendingStatut(2)");
  button3.innerHTML = "Liste des colis en cours de livraison";
  containerLeft.appendChild(button3);
  let button4 = document.createElement('button');
  button4.setAttribute("onclick", "getListColisBySendingStatut(3)");
  button4.innerHTML = "Liste des colis livrés";
  containerLeft.appendChild(button4);

  let h2 = document.createElement('h2');
  h2.innerHTML = "Liste de tous les colis";
  containerLeft.appendChild(h2);

  let buttonSearchMail = document.createElement('button');
  buttonSearchMail.setAttribute("onclick", "searchColis(1)");
  buttonSearchMail.innerHTML = "Faire une recherche par le mail";
  containerLeft.appendChild(buttonSearchMail);

  let buttonSearchId = document.createElement('button');
  buttonSearchId.setAttribute("onclick", "searchColis(2)");
  buttonSearchId.innerHTML = "Faire une recherche par l'id";
  containerLeft.appendChild(buttonSearchId);

  let ObjJson;
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/list.php?limit=10000000&offset=0",true);
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
                      let th2 =  document.createElement("th");
                      let th3 =  document.createElement("th");
                      let th4 =  document.createElement("th");
                      th1.innerHTML = "ID";
                      th2.innerHTML = "Mail du destinataire";
                      th3.innerHTML = "Etat de livraison du colis";
                      th4.innerHTML = "Le colis est payé";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);
                      tr1.appendChild(th2);
                      tr1.appendChild(th3);
                      tr1.appendChild(th4);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          let a1 = document.createElement("a");
                          td1.appendChild(a1);
                          a1.innerHTML = String(element["id"]);
                          a1.setAttribute("onclick", 'listInfosColis("' + String(element["id"]) + '")');
                          a1.setAttribute("href", "#section" + String(element["id"]));
                          let td2 = document.createElement("td");
                          nwLine.appendChild(td2);
                          td2.innerHTML = String(element["recipientMail"]);
                          let td3 = document.createElement("td");
                          nwLine.appendChild(td3);
                          if (String(element["sendingStatut"]) == "0") {
                            td3.innerHTML = "Le colis n'est pas encore au dépot";
                          }else if (String(element["sendingStatut"]) == "1") {
                            td3.innerHTML = "Le colis est au dépot";
                          }else if (String(element["sendingStatut"]) == "2") {
                            td3.innerHTML = "Le colis est en cours de livraison";
                          }else if (String(element["sendingStatut"]) == "3") {
                            td3.innerHTML = "Le colis est livré";
                          }
                          let td4 = document.createElement("td");
                          nwLine.appendChild(td4);
                          if (String(element["isPayed"]) == "1") {
                            td4.innerHTML = "Payé";
                          }else if (String(element["isPayed"]) == "0") {
                            td4.innerHTML = "A payer";
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

function getListVehicule() {
  let newDiv = document.getElementById("section2");
  let containerLeft = document.createElement('div');
  containerLeft.setAttribute("class", "col");
  newDiv.appendChild(containerLeft);
  let h2 = document.createElement('h2');
  h2.innerHTML = "Liste de tous les véhicules";
  containerLeft.appendChild(h2);
  let buttonSearch = document.createElement('button');
  buttonSearch.setAttribute("onclick", "searchVehicule()");
  buttonSearch.innerHTML = "Faire une recherche par l'immatriculation";
  containerLeft.appendChild(buttonSearch);

  let ObjJson;
  let request = new XMLHttpRequest();
  request.open("GET","https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/list.php?limit=1000000000&offset=0",true);
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
                      th1.innerHTML = "Immatriculation";
                      containerLeft.appendChild(tabBase);
                      tabBase.appendChild(tr1);
                      tr1.appendChild(th1);


                      ObjJson.forEach(
                        element => {
                          let nwLine =  document.createElement("tr");
                          tabBase.appendChild(nwLine);
                          let td1 = document.createElement("td");
                          nwLine.appendChild(td1);
                          let a1 = document.createElement("a");
                          td1.appendChild(a1);
                          a1.innerHTML = String(element["imatriculation"]);
                          a1.setAttribute("onclick", 'listInfosVehicule("' + String(element["id"]) + '")');
                          a1.setAttribute("href", "#section" + String(element["id"]));
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

function gestionMenu(id) {
  if (id == 1) {
    div.innerHTML = "";
    let divSection = document.createElement('div');
    divSection.setAttribute("id", "section1");
    div.appendChild(divSection);
    let h1 = document.createElement('h1');
    h1.innerHTML = "Gestion des clients";
    divSection.appendChild(h1);
    getListUser(3);
  }else if (id == 2) {
    div.innerHTML = "";
    let divSection = document.createElement('div');
    divSection.setAttribute("id", "section2");
    div.appendChild(divSection);
    let h1 = document.createElement('h1');
    h1.innerHTML = "Gestion des livreurs";
    divSection.appendChild(h1);
    getListUser(1);
    getListVehicule();
  }else if (id == 3) {
    div.innerHTML = "";
    let divSection = document.createElement('div');
    divSection.setAttribute("id", "section3");
    div.appendChild(divSection);
    let h1 = document.createElement('h1');
    h1.innerHTML = "Gestion des particuliers";
    divSection.appendChild(h1);
    getListRecipient();
  }else if (id == 4) {
    div.innerHTML = "";
    let divSection = document.createElement('div');
    divSection.setAttribute("id", "section4");
    div.appendChild(divSection);
    getListColis(0);
  }else if (id == 5) {
    div.innerHTML = "";
    let divSection = document.createElement('div');
    divSection.setAttribute("id", "section5");
    div.appendChild(divSection);
    createAdminForm();
    let h1 = document.createElement('h1');
    h1.innerHTML = "Gestion des administrateurs";
    divSection.appendChild(h1);
    getListUser(2);
  }


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
