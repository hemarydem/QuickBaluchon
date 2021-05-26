let div = document.getElementById("main");
let container = document.getElementById("di");
id = parseInt(container.innerHTML);
container.innerHTML = "";
listInfosUser();

function listInfosUser() {
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
                      h1.innerHTML = "Votre fiche :" + String(ObjJson["nom"]) + " " + String(ObjJson["prenom"]);
                      let p1 = document.createElement("p");
                      containerLeft.appendChild(p1);
                      p1.innerHTML = "Prenom : " + String(ObjJson["prenom"]) + "<br>" + "Nom : " + String(ObjJson["nom"]) + "<br>" + "Mail : " + String(ObjJson["mail"]) + "<br>" + "Adresse : " + String(ObjJson["adresse"]) + "<br>" + "Numéro de téléphone : " + String(ObjJson["tel"]);
                      let p2 = document.createElement("p");
                      containerLeft.appendChild(p2);
                      p2.innerHTML = "Numéro de SIRET : " + String(ObjJson["numSiret"]);
                      getListColisByIdUser(id);
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

                  }
                } else {
                    alert("Error: returned status code " + request.status + " " + request.statusText);
                }
            }
        }
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send();
}
