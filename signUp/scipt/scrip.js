/* FILE EDITE BY:
 *                 - YANIS TAGRI
 *                 - PEROCHON LÉO
 *                 - HAMED Rémy
 * FILE purpose:
 * get feed back to the user to make hime now if inputs are filled correctly
 * check if input are correctly filled to be send to the api
 */
let webSitePath ="https://quickbaluchonservice.site";
let homePage =[webSitePath + "/QuickBaluchon/home/homeDriver.php", webSitePath + "/QuickBaluchon/home/homeAdmin.php",webSitePath + "/QuickBaluchon/home/homeUser.php"];

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

    let allowedSend = [true,true,true,true,true,true,true];
    
    allowedSend[0] = checkInput("name",50,OnlyNumberNot,OnlyLetter,canContainSpace);
    
    allowedSend [1]= checkInput("firstname",50,OnlyNumberNot,OnlyLetter,canContainSpace);
    
    allowedSend[2] = checkInput("pssword",255,OnlyNumberNot,OnlyLetterNot,mustNotContainSpace);

    allowedSend[3] = checkInput("address",255,OnlyNumberNot,OnlyLetterNot,canContainSpace);

    allowedSend[4] = checkInput("tel",10,OnlyNumber,OnlyLetterNot,mustNotContainSpace);

    allowedSend[5] = checkInput("mail",255,OnlyNumberNot,OnlyLetterNot,mustNotContainSpace);

    if(parseInt(document.getElementById("statut").value,10) == 3){
        console.log("client");
        allowedSend[6] = checkInput("numSiret",50,OnlyNumberNot,OnlyLetterNot,mustNotContainSpace);
    } else {
        document.getElementById("erronumSiret").innerHTML="";
    }
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
        ajaxSendPost(getData(),"https://quickbaluchonservice.site/api/QuickBaluchon/users/post/creat.php");
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



function ajaxSendPost(data,urlLink) {
        //driver 1
        //admin 2
        //client3
        let jsonToSend = {
            nom:data[0],
            prenom:data[1],
            mail:data[2],
            adresse:data[3],
            numSiret:data[4],
            password:data[5],
            tel:data[6],
            driverLicence:0,
            statut:data[7],
            busy:0,
            zoneMaxDef:0
        };
        let request = new XMLHttpRequest();  
        request.open("POST",urlLink,true); 
        request.onreadystatechange = function() {
            if(request.readyState == 4) {
                    if(request.status == 200) {
                        let ObjeJson =  ObjJson = JSON.parse(request.responseText);
                        console.log(ObjeJson);
                        let num = ObjJson["statut"].toString();
                        num = parseInt(num);
                        num--;
                        homePage[num];
                        console.log(homePage[num]);
                        window.location.href = homePage[ObjJson["statut"] - 1];
                } else {
                    alert("Error: returned status code " + request.status + " " + request.statusText);
                }
            }
        }
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send(JSON.stringify(jsonToSend));
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
    let name = document.getElementById("name").value;
    let firstname = document.getElementById("firstname").value;
    let mail = document.getElementById("mail").value;//
    let numSiret= document.getElementById("numSiret").value;
    let address = document.getElementById("address").value;
    let password= document.getElementById("pssword").value;//
    let tel = document.getElementById("tel").value;//
    let statut = document.getElementById("statut").value;
    name = name.trim();
    firstname = firstname.trim();
    mail = mail.trim();
    numSiret= numSiret.trim();
    address = address.trim();
    password = password.trim();
    tel = tel.trim();
   

    mail = mail.replace(/\s/, ''); 
    tel = tel.replace(/\s/, '');
    if(numSiret.length != 0){
        numSiret = numSiret.replace(/\s/, '');
    } else {
        numSiret = 0;
    }
    let array = [name,firstname,mail,address,numSiret,password,tel,statut];
    return array;
}




/*
 *  checkLenForValidate
 * args
 * the string and the max lenght
 *
 * trim and check if the str is not to long
 * 
 * 
 * return a boolean 
 * 
 * */

function checkLenForValidate(str, lengMax) {
    str = str.trim();
    if(str === "")
        return false;
    if(str.length <= 0)
        return false;
    if(str.length > lengMax)
        return false;
    return true;
}


/*
 *  isValideInt
 *
 *  arg id of an element
 *  
 * check if the input got only numbers
 * 
 * return a boolean
 * */
function isValideInt(str) {
    str = str.trim();
    str.replace(/\s/, '')
    if(str.match(/^\d+$/)){
        return true;
    }
    return false;
}


/*
 *  isValideStringOnlyLetter
 *
 *  arg id of an string
 *  
 * check if the input got only letters
 * 
 * return a boolean
 * */
function isValideStringOnlyLetter(str) {
    str = str.trim;
    if(str.match(/^[a-z]+$/)){
        return true;
    }
    return false;
}



