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
countJsonObjElem($data, 5);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
insertDepot(
    "DEPOT",
    $data->{"longitude"},
    $data->{"latitude"},
    $data->{"ville"},
    $data->{"adresse"},
    $data->{"codePostale"});