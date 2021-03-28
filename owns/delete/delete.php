<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
checkStringsArray($_GET,1);
$idCheck = buildParams($_GET);
$sql = buildsDeleteForMixPRymariKeyTab("own", $_GET);
//echo $sql;
$params = ArrayOfstrToIntJsonObjElem($idCheck);
if (execRequestDelete($sql, $params)) {
    header('Content-type: Application/json');
    echo json_encode(["success"=>1]);
} else {
    http_response_code(400);
}
