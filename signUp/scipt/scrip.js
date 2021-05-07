
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