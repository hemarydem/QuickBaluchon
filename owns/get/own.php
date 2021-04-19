<?php
include("./../functions/functions.php");
include ("./../../chckFnctns/chckFnctns.php");
include ("./../../listfnctns/listfnctns.php");
if(isset($_GET)) {
    if(isset($_GET['tokenApi'])) {
        chekIfRequestFromShield($_GET['tokenApi']);
        unset($_GET['tokenApi']);
    } else {
        erro400NotConnectJsonMssg( "token api is not set");
    }
    //print_r($_GET);
    checkStringsArray($_GET, 1);
    $sql = buildsSelectAndattributsForMixePrimaryKey($_GET, "own");
    $params = buildParamsForMixePrimaryKey($_GET);
    //echo $sql;
    //print_r($params);
    $rows = dataBaseFindOneForMixePrimaryKey($sql,$params); //db.php
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}


