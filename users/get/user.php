<?php
include("./../functions/functions.php");
include ("./../../chckFnctns/chckFnctns.php");
include ("./../../listfnctns/listfnctns.php");
if(isset($_GET)) {
   /* if(isset($_GET['tokenApi'])) {
        chekIfRequestFromShield($_GET['tokenApi']);
        unset($_GET['tokenApi']);
    } else {
        erro400NotConnectJsonMssg( "token api is not set");
    }*/
    checkStringsArray($_GET,1);
    $id = intval($_GET['id']);
    $tab = "USER";
    if(!isExistInDb($id,$tab)){
        http_response_code(400);
        exit(1);
    }
    //echo $id;
    unset($_GET['id']);
    $sql = buildsSelectAndattributs($_GET, $tab);//listfnctns.php
    $sql .= " WHERE id = ?";
    //echo $sql;
    $rows = dataBaseFindOne($sql,(int)$id); //db.php
    $json = json_encode($rows);
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    print_r($json);

} else {
    http_response_code(500);
}