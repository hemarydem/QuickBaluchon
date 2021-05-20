<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
/*if(isset($data['tokenApi'])) {
    chekIfRequestFromShield($data['tokenApi']);
    unset($data['tokenApi']);
} else {
    erro400NotConnectJsonMssg( "token api is not set");
}*/
$intKey = [
    "idVehicule",
    "idUser"
];
header("Access-Control-Allow-Origin: *");
countJsonObjElem($data, 2);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
insertOwn(
     "OWN",
    $data->{"idVehicule"},
    $data->{"idUser"},
     1,
    [
        "idVehicule" => $data->{"idVehicule"},
        "idUser" => $data->{"idUser"}
    ]);
