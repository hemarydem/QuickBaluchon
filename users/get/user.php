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

//
//$sql ='SELECT '. $_GET['attributs'] ." FROM user ";
//unset($_GET['attributs']);

//if ($statement !== false) {
//    $success = $statement->execute($params);
//    if ($success) {
//        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
//        $json = json_encode($rows);
//        header("Content-Type: application/json");
//        print_r($json);
//    } else {
        //echo "error";
//        http_response_code(500);
//    }
//}