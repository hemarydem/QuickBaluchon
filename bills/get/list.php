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
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 20;
    if ($_GET['offset'] >= $_GET['limit']) {
        http_response_code(400);
        exit(1);
    }
    $where = [];
    $params = [];
    $wAndp = buildsLIkes($where, $params, $_GET);
    $where = $wAndp[0];
    $params = $wAndp[1];
    $tab = "bill";
    unset($_GET['offset']);
    unset($_GET['limit']);
    $sql = buildsSelectAndattributByParam($_GET, $tab);
    if (count($where) > 0) {
        $whereClause = join(" AND ", $where);
        $sql .= " WHERE " . $whereClause;
    }
    $sql .= " LIMIT $offset,$limit";
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if ($statement !== false) {
        $success = $statement->execute($params);
        if ($success) {
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($rows);
            header("Content-Type: application/json");
            print_r($json);
        } else {
            http_response_code(500);
        }
    }
} else {
    http_response_code(500);
}