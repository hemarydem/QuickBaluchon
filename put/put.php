<?php
require_once ('../utils/database.php');

$json = file_get_contents('php://input');
$obj = json_decode ($json,false);
$id = $obj->{'id'};
$pw = $obj->{'pwd'};
$where = [];
$params = [];

if(isset($id) && !empty($id)) {
  array_push( $where, 'id = ?');
  $params[] = $obj->{'id'}; //eq array_push
} else {
    http_response_code(500);
    echo "0";
    exit;
}

if(isset($pw) &&  !empty($pw)) {
  $where[] =  'pwd = ?';
  $params[] = $obj->{'pwd'}; //eq array_push
} else {
  http_response_code(500);
  echo "0";
  exit;
}

$sql = 'SELECT id, pwd FROM USER';

if(count($where) > 0) {
    $whereClause = join(" AND ", $where);
    $sql .= " WHERE " . $whereClause;
}
$db = getDataBaseConnection();
$statement = $db->prepare($sql);
if($statement !== false) {
  $success = $statement->execute($params);
  if($success) {
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    if(count($rows) == 1) {
      echo "1";
    } else {
      echo "0";
    }
    
  }
}
    /*$json = json_encode($rows);
    header("Content-Type: application/json");
    echo $json;
  } else {
    http_response_code(500);
  }
}

*/
?>