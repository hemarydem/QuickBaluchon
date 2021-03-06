<?php
include ("./../../utils/db.php");
include ("./../../chckFnctns/chckFnctns.php");

$content = file_get_contents('php://input');
$data = json_decode($content, false);
$intKey = [
    "driverLicence",
    "statut",
    "busy",
    "zoneMaxDef"
];
countJsonObjElem($data, 11);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data,$intKey);         // cast elements
$db = getDataBaseConnection();
$sql = "INSERT INTO user( nom, prenom, mail, adresse, numSiret, password, tel, driverLicence, statut, busy, zoneMaxDef) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
$statement = $db->prepare($sql);
if($statement !== false) {//!$statement
    $success = $statement->execute([
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
        $data->{"zoneMaxDef"}]);
    if ($success) {
        //http_response_code(201);
        $lastId = $db->lastInsertId();
        $sql = "SELECT nom, prenom, mail FROM user WHERE id = ?";
        $statement = $db->prepare($sql);
        codeIsRun(4);
        if ($statement !== false) {
            $success = $statement->execute([
                $lastId
            ]);
            echo  $success;
            codeIsRun(5);;
        } else {
            http_response_code(500);
        }
    }else {
        http_response_code(500);
    }
}
