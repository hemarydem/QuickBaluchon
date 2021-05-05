document.getElementById("imgQB").src="../img/logo2.png";
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
}