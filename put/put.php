<?php



require_once ('../utils/database.php');

/*function decryptKey($result) {
  $key = (int) $result;
  $result = intval(log10($key)+1);
  if ($result == 9) {             //success
    $result = (sqrt($key))/100;
    $result = (int) $result;
    return $result;
  } else {                        //error
    echo "0";
  }
}
*/


$json = file_get_contents('php://input');



$obj = json_decode ($json,false);
$id = $obj->{'id'};
$pw = $obj->{'pwd'};

$encryptedData = "prg.exe \"" . $id . "\" \"". $pw . "\"";
exec($encryptedData, $output, $retval);
//print_r($output);

$id = $output[1];
$pw = $output[2];

$where = [];
$params = [];
if(isset($id) && !empty($id)) {
  array_push( $where, 'id = ?');
  $params[] = $id; //eq array_push
} else {
    http_response_code(500);
    echo "0";
    exit;
}

if(isset($pw) &&  !empty($pw)) {
  $where[] =  'pwd = ?';
  $params[] = $pw; //eq array_push
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
      echo "0 \n erreur de connexion";
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