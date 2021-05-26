<?php
$content = file_get_contents('php://input');
$data = json_decode($content, true);
foreach ($data as $key => $value ){
    $data[$key]["longitude"] = 0;
    $data[$key]["latitude"] = 0;
}

foreach ($data as $key => $value ){
    $address = str_replace('\'', '',  $data[$key]["adresse"]);
    $address = str_replace(' ', '+',  $address);
    $urlBase = "https://api-adresse.data.gouv.fr/search/?q=".$address."+".$data[$key]["codePostale"];
    echo $urlBase;
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    header('Content-type: Application/json');
    print_r($result);

    //$data[$key]["longitude"] = 0;
   // $data[$key]["latitude"] = 0;
}

