<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content, true);
/*if(isset($data['tokenApi'])) {
    chekIfRequestFromShield($data['tokenApi']);
    unset($data['tokenApi']);
} else {
    erro400NotConnectJsonMssg( "token api is not set");
}*/
$idCheck = intval($data['id']);
$tab = "DELIVERYRATE";
//echo $idCheck;
$intKey = [
    "costByKm",
    "costByColis",
    "primeWeight",
    "idUser"
];
strToIntAssiArrayElem($data, $intKey); //TODO must return array currently the function has no effects
$sql = buildsUpdateAndattributs($tab, $data);
//echo $sql;
unset($data['id']);
$params = buildParams($data);
//print_r($params);
if (execRequestUpdate($sql, $params)) {
    header('Content-type: Application/json');
    echo json_encode(execRequest("SELECT * FROM " . $tab . " WHERE ID =?", [$idCheck]));
} else {
    http_response_code(400);
}