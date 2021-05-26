<?php
$content = file_get_contents('php://input');
$data = json_decode($content, true);


foreach ($data as $key =>$value ){
    $key["longitude"] = 0;
    $key["latitude"] = 0;
}
print_r($data);
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