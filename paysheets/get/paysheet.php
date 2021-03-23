<?php
include("./../functions/functions.php");
include ("./../../chckFnctns/chckFnctns.php");
include ("./../../listfnctns/listfnctns.php");
if(isset($_GET)) {
    $id = $_GET['id'];
    unset($_GET['id']);
    $sql = buildsSelectAndattributs($_GET, "user");//listfnctns.php
    $sql .= " WHERE id = ?";
    $rows = dataBaseFindOne($sql,(int)$id); //db.php
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}
