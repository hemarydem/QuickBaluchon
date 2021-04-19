<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
if(isset($_GET)) {
        if(isset($_GET['tokenApi'])) {
            chekIfRequestFromShield($_GET['tokenApi']);
            unset($_GET['tokenApi']);
        } else {
            erro400NotConnectJsonMssg( "token api is not set");
        }
    $idCheck = intval($_GET['id']);
    $sql = buildsDelete("paysheet", $idCheck);
    $params = array($idCheck);
    if (execRequestDelete($sql, $params)) {
        header('Content-type: Application/json');
        echo json_encode(["success"=>1]);
    } else {
        http_response_code(400);
    }
} else {
    http_response_code(500);
}