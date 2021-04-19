<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content, true);
if(isset($data['tokenApi'])) {
    chekIfRequestFromShield($data['tokenApi']);
    unset($data['tokenApi']);
} else {
    erro400NotConnectJsonMssg( "token api is not set");
}
$intKey = [
    "idDepot",
    "idUser"
];
countArrElem($data, 2);   // must have 11 elements
//areSetJsonObjElem($data);                   //TODO function check elements are init
$data = strToIntJsonArray($data, $intKey);  // cast elements
insertDeposit(
    "deposit",
    $data["idDepot"],
    $data["idUser"],
    [
        "idDepot" =>  $data["idDepot"],
        "idUser" => $data["idUser"]
    ]);
