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
    "cost",
    "idUser"
];
countJsonObjElem($data, 2);   // must have 11 elements
//areSetJsonObjElem($data);
// elements are init
//strToIntJsonObjElem($data, $intKey);         // cast elements
insertBill(
    "BILL",
    $data["cost"],
    $data["idUser"]);