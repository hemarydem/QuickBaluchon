<?php
include("./../functions/functions.php");
include ("./../../chckFnctns/chckFnctns.php");
include ("./../../listfnctns/listfnctns.php");
if(isset($_GET)) {
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
    echo $_SESSION["token"];
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}