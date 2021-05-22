
let div = document.getElementById("div");

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

function getListVehicule() {
  let newDiv = document.getElementById("section2");
  let containerLeft = document.createElement('div');
  containerLeft.setAttribute("class", "col");
  newDiv.appendChild(containerLeft);
  let h2 = document.createElement('h2');
  h2.innerHTML = "Liste de tous les véhicules";
  containerLeft.appendChild(h2);

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