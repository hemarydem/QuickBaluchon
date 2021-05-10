<?php
include ("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content, true);
/*if(isset($data['tokenApi'])) {
    chekIfRequestFromShield($data['tokenApi']);
    unset($data['tokenApi']);
} else {
    erro400NotConnectJsonMssg( "token api is not set");
}*/
header("Access-Control-Allow-Origin: *");
checkStringsArray($data,1);
$idCheck = intval($data['id']);
$tab = "USER";
if(!isExistInDb($idCheck,$tab)){
    http_response_code(400);
    exit(1);
}
$intKey = [
    "driverLicence",
    "statut",
    "busy",
    "zoneMaxDef",
    "id"
];
strToIntAssiArrayElem($data,$intKey); //TODO must return array currently the function has no effects
$sql = buildsUpdateAndattributs($tab,$data);
unset($data['id']);
$params = buildParams($data);
if(execRequestUpdate($sql, $params)) {

    header('Content-type: Application/json');
    echo json_encode(execRequest("SELECT * FROM ".$tab." WHERE ID =?", [$idCheck]));
} else {
    http_response_code(400);
}

