<?php
include ("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content, true);
$idCheck = intval($data['id']);
$intKey = [
    "driverLicence",
    "statut",
    "busy",
    "zoneMaxDef",
    "id"
];
//countJsonObjElem($data, 12);   // must have 11 elements
//areSetJsonObjElem($data);                   // elements are init
strToIntAssiArrayElem($data,$intKey);         // cast elements
$sql = buildsUpdateAndattributs("user",$data);
unset($data['id']);
$params = buildParams($data);
if(execRequestUpdate($sql, $params)) {
    print_r(execRequest("SELECT * FROM USER WHERE ID =?", [$idCheck]));
} else {
    http_response_code(400);
}
 /*
 execRequestUpdate($sql,[
     $data->{"nom"},
     $data->{"prenom"},
     $data->{"mail"},
     $data->{"adresse"},
     $data->{"numSiret"},
     $data->{"password"},
     $data->{"tel"},
     $data->{"driverLicence"},
     $data->{"statut"},
     $data->{"busy"},
     $data->{"zoneMaxDef"},
     $data->{"id"}]);
*/
