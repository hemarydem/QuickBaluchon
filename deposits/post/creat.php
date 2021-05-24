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
$intKey = [
    "idDepot",
    "idUser"
];
header("Access-Control-Allow-Origin: *");
if(execRequestALLreadyExist("SELECT idDepot, idUser, active FROM DEPOSIT WHERE idDepot=? AND idUser=?", [intval($data["idDepot"]),intval($data["idUser"])])){
    if(isset($data["active"])) {
        countArrElem($data, 3);
        $value = intval($data["active"]);
        if (execRequestUpdate("UPDATE DEPOSIT SET active = ? WHERE idDepot=? AND idUser=?", [$value,intval($data["idDepot"]),intval($data["idUser"])]) == 1) {
            header('Content-type: Application/json');
            echo json_encode(execRequest("SELECT * FROM DEPOSIT WHERE idDepot=? AND idUser=?", [intval($data["idDepot"]),intval($data["idUser"])]));
            exit(1);
        }
    } else {
        header("Content-Type: application/json");
        echo json_encode(["message"=> "DEPOSIT déjà enregistré"]);
        exit(1);
    }
}
countArrElem($data, 2);   // must have 11 elements
//areSetJsonObjElem($data);                   //TODO function check elements are init
$data = strToIntJsonArray($data, $intKey);  // cast elements
insertDeposit(
    "DEPOSIT",
    $data["idDepot"],
    $data["idUser"],
    1,
    [
        "idDepot" =>  $data["idDepot"],
        "idUser" => $data["idUser"]
    ]);
