<?php
include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
checIfsessionStarted();
if (isset($_GET)) {
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
    if($rows["active"] == 1) {
        foreach ($rows as $key => $value) {
            $_SESSION[$key."_session"] = $value;
        }
        $json = json_encode($rows);
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        print_r($json);
        print_r($_SESSION);
    } else {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
        echo json_encode(["message"=> "le compte doit être activé ou à été bloqué"]);
        exit(1);
    }
} else {
    http_response_code(500);
}