<?php
include ("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
/*if(isset($data->{'tokenApi'})) {
    chekIfRequestFromShield($data->{'tokenApi'});
    unset($data->{'tokenApi'});
} else {
    erro400NotConnectJsonMssg( "token api is not set");
}*/



$intKey = [
    "driverLicence",
    "statut",
    "busy",
    "zoneMaxDef"
];
header("Access-Control-Allow-Origin: *");
countJsonObjElem($data, 11);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data,$intKey);         // cast elements
checkStringsArray((array)$data,1);
if(execRequestALLreadyExist("SELECT mail FROM USER WHERE mail=?", [$data->{"mail"}])){
    header("Content-Type: application/json");
    echo json_encode(["message"=> "mail alreayd use"]);
    exit(1);
}
if (!filter_var($data->{"mail"}, FILTER_VALIDATE_EMAIL)) {
    header("Content-Type: application/json");
    echo json_encode(["message"=> "is not a mail"]);
    exit(1);
}

insertUser(
    "USER",
    $data->{"nom"},
    $data->{"prenom"},
    $data->{"mail"},
    $data->{"adresse"},
    $data->{"numSiret"},
    hash("sha256", $data->{"password"}),
    $data->{"tel"},
    $data->{"driverLicence"},
    $data->{"statut"},
    $data->{"busy"},
    $data->{"zoneMaxDef"},
    0);

