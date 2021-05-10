<?php
header("Access-Control-Allow-Origin: *");
include("./../functions/functions.php");
include ("./../../chckFnctns/chckFnctns.php");
include ("./../../listfnctns/listfnctns.php");
if(isset($_GET)) {
    /*if(isset($_GET['tokenApi'])) {
        chekIfRequestFromShield($_GET['tokenApi']);
        unset($_GET['tokenApi']);
    } else {
        erro400NotConnectJsonMssg( "token api is not set");
    }*/
    checkStringsArray($_GET,1);
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 20;
    if($_GET['offset'] >= $_GET['limit']) {
        http_response_code(400);
        exit(1);
    }
    $where = [];
    $params = [];
    $wAndp = buildsLIkes($where,$params, $_GET);
    $where = $wAndp[0];
    $params = $wAndp[1];
//print_r($where);
//print_r($params);
//TODO TEST TO ADAPT THE CODE WITH THE FUNCTION BELOW TO MAke the request dynamique
// $sql = buildsSelectAndattributs($_GET, "user");//listfnctns.php
    $sql = 'SELECT nom, prenom, mail, adresse, numSiret, password, tel, driverLicence, statut, busy, zoneMaxDef, id FROM USER';
    if (count($where) > 0) {
        $whereClause = join(" AND ", $where);
        $sql .= " WHERE " . $whereClause;
    }
//echo $sql."\n\n";
    $sql .= " LIMIT $offset, $limit";
//echo $sql;
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
            //echo "error";
            http_response_code(500);
        }
    }
} else {
    //echo "error";
    http_response_code(500);
}