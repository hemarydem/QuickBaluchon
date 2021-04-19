<?php
include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
if(isset($_GET)) {
    if(isset($_GET['tokenApi'])) {
        chekIfRequestFromShield($_GET['tokenApi']);
        unset($_GET['tokenApi']);
    } else {
        erro400NotConnectJsonMssg( "token api is not set");
    }
    $id = $_GET['id'];
    unset($_GET['id']);
    $sql = buildsSelectAndattributs($_GET, "bill");//listfnctns.php
    $sql .= " WHERE id = ?";
    $rows = dataBaseFindOne($sql, (int)$id); //db.php
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}