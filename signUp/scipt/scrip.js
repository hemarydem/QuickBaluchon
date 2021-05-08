
function isValideString(elemen) {
    let data = Element.value;
    data = data.trim;
    if(data.match(/^[a-z]+$/)){
        return true;
    }
    return false;
}
function isValideInt(elemen) {
    let data = Element.value;
    data = data.trim;
    data.replace(/\s/, '')
    if(data.match(/^\d+$/)){
        return true;
    }
    return false;
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