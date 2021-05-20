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
    "nbColis",
    "volumeMax",
    "weightMax"
];
header("Access-Control-Allow-Origin: *");
countJsonObjElem($data, 4);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);        // cast elements
if(execRequestALLreadyExist("SELECT imatriculation FROM VEHICULE WHERE imatriculation=?", [$data->{"imatriculation"}])){
    header("Content-Type: application/json");
    echo json_encode(["message"=> "vehicule déjà enregistré"]);
    exit(1);
}
insertVehicules(
    "VEHICULE",
    $data->{"imatriculation"},
    $data->{"nbColis"},
    $data->{"volumeMax"},
    $data->{"weightMax"},
    $data->{"employ"},
    $data->{"active"}
    );
