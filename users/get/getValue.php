<?php
include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
checIfsessionStarted();
if (isset($_GET)) {
    /* if(isset($_GET['tokenApi'])) {
         chekIfRequestFromShield($_GET['tokenApi']);
         unset($_GET['tokenApi']);
     } else {
         erro400NotConnectJsonMssg( "token api is not set");
     }*/
    checkStringsArray($_GET,1);
    if(isset($_GET['password']))
        $_GET['password'] = hash("sha256",  $_GET['password']);
    $tab = "USER";
    $sql = buildsSelectattributs($_GET, $tab);//listfnctns.php
    $params = buildParams($_GET);
    $rows = execRequest( $sql, $params);
    if($rows == null) {
        header("Content-Type: application/json");
        echo json_encode(["message"=> "no result found"]);
        exit(1);
    }
    $json = json_encode($rows);
    foreach ($rows as $key => $value) {
        $_SESSION[$key."_session"] = $value;
    }
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}