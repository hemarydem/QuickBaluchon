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
header("Access-Control-Allow-Origin: *");
$intKey = [
    "volume",
    "weight",
    "distance"
];
countJsonObjElem($data, 3);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
insertDelivery(
    "DELIVERY",
    $data->{"volume"},
    $data->{"weight"},
    $data->{"distance"});