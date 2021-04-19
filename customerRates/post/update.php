<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
include ("./../../listfnctns/listfnctns.php");
$content = file_get_contents('php://input');
$data = json_decode($content, true);
if(isset($data['tokenApi'])) {
    chekIfRequestFromShield($data['tokenApi']);
    unset($data['tokenApi']);
} else {
    erro400NotConnectJsonMssg( "token api is not set");
}
checkStringsArray($data, 1);
$tab = "customerRate";
$intKey = [
    "weight",
    "cost",
    "expressCost",
    "mode"
];
//création du tableau params
$attributsToset = buildAttributArrayFromData($data,["weight","mode"]);
//strToIntAssiArrayElem($data, $intKey); //TODO must return array currently the function has no effects
$sql = buildsUpdateAndattributsForMixPRymariKeyTab($tab, $attributsToset,["cost", "expressCost"]);
$params = buildParams($data);
if (execRequestUpdate($sql, $params)) {
    header('Content-type: Application/json');
    $sql = buildsSelectAndattributsForMixePrimaryKey($data, $tab);
    echo json_encode(execRequest($sql, $params));
} else {
    http_response_code(400);
}