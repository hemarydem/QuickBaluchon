<?php
include ("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content, true);
$idCheck = intval($data['id']);
$tab = "VEHICULE";
$intKey = [
  "nbColis",
  "volumeMax",
  "weightMax",
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
