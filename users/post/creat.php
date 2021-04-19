<?php
include ("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
if(isset($data['tokenApi'])) {
    chekIfRequestFromShield($_GET['tokenApi']);
} else {
    erro400NotConnectJsonMssg( "token api is not set");
}
$intKey = [
    "driverLicence",
    "statut",
    "busy",
    "zoneMaxDef"
];
countJsonObjElem($data, 11);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data,$intKey);         // cast elements
insertUser(
    "user",
    $data->{"nom"},
    $data->{"prenom"},
    $data->{"mail"},
    $data->{"adresse"},
    $data->{"numSiret"},
    $data->{"password"},
    $data->{"tel"},
    $data->{"driverLicence"},
    $data->{"statut"},
    $data->{"busy"},
    $data->{"zoneMaxDef"});

