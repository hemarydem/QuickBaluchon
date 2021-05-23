<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "idVehicule",
    "idUser"
];
header("Access-Control-Allow-Origin: *");
  // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
if(execRequestALLreadyExist("SELECT idVehicule, idUser, active FROM OWN WHERE idVehicule=? AND idUser=?", [intval($data->{"idVehicule"}),intval($data->{"idUser"})])){
    if(isset($data->{"active"})) {
        countJsonObjElem($data, 2);
        $value = intval($data->{"active"});
        if (execRequestUpdate("UPDATE OWN SET active = ? WHERE idVehicule=? AND idUser=?", [$value,intval($data->{"idVehicule"}),intval($data->{"idUser"})]) == 1) {
            header('Content-type: Application/json');
            echo json_encode(execRequest("SELECT * FROM OWN WHERE idVehicule=? AND idUser=?", [intval($data->{"idVehicule"}),intval($data->{"idUser"})]));
            exit(1);
        }
    } else {
        header("Content-Type: application/json");
        echo json_encode(["message"=> "OWNERSHIP déjà enregistré"]);
        exit(1);
    }
}
countJsonObjElem($data, 2);
insertOwn(
     "OWN",
    $data->{"idVehicule"},
    $data->{"idUser"},
     1,
    [
        "idVehicule" => $data->{"idVehicule"},
        "idUser" => $data->{"idUser"}
    ]);
