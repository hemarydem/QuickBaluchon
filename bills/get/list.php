<?php
include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
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
//print_r($where);
//echo "params ";
//print_r($params);
//echo "\n\n";
//print_r($_GET);
unset($_GET['offset']);
unset($_GET['limit']);
//print_r($_GET);
$sql = buildsSelectAndattributByParam($_GET, $tab);
//echo "\n1 " . $sql . "\n\n";
if (count($where) > 0) {
    $whereClause = join(" AND ", $where);
    $sql .= " WHERE " . $whereClause;
}
//echo $sql."\n\n";
$sql .= " LIMIT $offset,$limit";
//$sql = substr($sql, 0, -1);
//echo $sql;
$db = getDataBaseConnection();
$statement = $db->prepare($sql);
//echo "\n";
//flagation(1);
if ($statement !== false) {
    //flagation(2);
    $success = $statement->execute($params);
    //flagation(3);
    if ($success) {
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        //flagation(4);
        $json = json_encode($rows);
        header("Content-Type: application/json");
        print_r($json);
    } else {
        //echo "error";
        http_response_code(500);
    }
}