<?php
include("./../functions/functions.php");
include ("./../../chckFnctns/chckFnctns.php");
include ("./../../listfnctns/listfnctns.php");
header("Access-Control-Allow-Origin: *");
if(isset($_GET)) {
    checkStringsArray($_GET, 1);
    $sql = buildsSelectAndattributsForMixePrimaryKey($_GET, "DEPOSIT");
    $params = buildParamsForMixePrimaryKey($_GET);
    $rows = dataBaseFindOneForMixePrimaryKey($sql,$params); //db.php
    if($rows == null){
        header("Content-Type: application/json");
        echo json_encode(["message"=> "DEPOSIT not found"]);
        exit(1);
    }
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}

