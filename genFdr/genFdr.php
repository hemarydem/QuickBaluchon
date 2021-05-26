<?php

if(isset($_POST)){
    print_r($_POST);

}


/*
$urlBase = "https://api-adresse.data.gouv.fr/search/?q=43+chemin+de+la+source+78590";
$cURLConnection = curl_init();
curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($cURLConnection);
curl_close($cURLConnection);
header('Content-type: Application/json');
print_r($result);
*/