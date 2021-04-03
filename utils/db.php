<?php
//'mysql:host=localhost;dbname=sananair;port=8889;charset=utf8', 'jo','r626wst100'
function getDataBaseConnection(): PDO {
    //sConnect to a MySQL database using driver invocation
    $dsn = 'mysql:dbname=qb;host=localhost';
    $user = 'root';
    $password = 'root';
    try {
       return $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}


function dataBaseInsert(PDO $connect, string $sql, array $params, string $tabName) {
    $statement = $connect->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            $id  = $connect->lastInsertId();
            header('Content-type: Application/json');
            //echo $id;
            echo json_encode(execRequest("SELECT * FROM ".$tabName." WHERE ID =?", [$id]));
            return $id;
        }
    }
    return NULL;
}

function dataBaseInsertForMixePrimaryKey(PDO $connect, string $sql, array $params, string $tabName,array $keyValues):?int {
    $statement = $connect->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            $str = " WHERE ";
            $trigger = false;
            foreach ($keyValues as $key => $prymaryKey) {
                if($trigger)
                    $str .= " AND ";
                $str .= $key . "=?";
                if(!$trigger)
                    $trigger = true;
            }
            //echo "str = " .$str;
            $keys = buildParams($keyValues);
            //print_r($keys);
            header('Content-type: Application/json');
            $str = "SELECT * FROM ".$tabName.$str;
            //echo $str;
            echo json_encode(execRequest($str,$keys));
            return 0;
        }
    }
    return NULL;
}

function buildsUpdateAndattributs(string $tabNameInDb, array $attributsToset) :?string {
    if(isset($attributsToset['id'])) {
        $id = intval($attributsToset['id']);
        unset($attributsToset['id']);
    } else {
        http_response_code(500);
        return null;
    }
    $str = "UPDATE " . $tabNameInDb . " SET";
    foreach ($attributsToset as $key => $value) {
        $str .= " " . $key . " = ?,";
    }
    $str = substr($str, 0, -1);
    $str .= " WHERE id =" . $id;
    //echo $str;
    return  $str;
}




function buildsDelete(string $tabNameInDb, int $id) :?string {
    if(is_int($id) ) {
        $sql = "DELETE FROM ".$tabNameInDb." WHERE id = ?";
    } else {
        http_response_code(500);
        return null;
    }
    return  $sql;
}

function buildsDeleteForMixPRymariKeyTab(string $tabNameInDb, array $id) :?string {

    foreach ($id as $item)
        $item = intval($item);
    $str = " WHERE ";//TODO build a fucntion from this code is repeat also in dataBaseInsertForMixePrimaryKey()
    $trigger = false;
    foreach ($id as $key => $prymaryKey) {
        if($trigger)
            $str .= " AND ";
        $str .= $key . "=?";
        if(!$trigger)
            $trigger = true;
    }
        $sql = "DELETE FROM ".$tabNameInDb.$str;
    return  $sql;
}

function execRequest(string $sql, array $params):?array {
    //echo $sql. "\n";
    //print_r($params);
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
    return NULL;
}

function execRequestUpdate(string $sql, array $params) {
    //echo $sql. "\n";
    //print_r($params);
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            return 1;
        }
    }
    return NULL;
}

function execRequestDelete(string $sql, array $params) :?int {
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            return true;
        }
    }
    return NULL;
}

function dataBaseFindOne(string $sql, int $id) :?array {
    $db = getDataBaseConnection();
    //echo   $sql;
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute([$id]);
        if($success) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            //echo "error";
            http_response_code(500);
        }
    }
    return NULL;
}

function dataBaseFindAll(PDO $connect, string $sql, array $params) :?array {
    $statement = $connect->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute(params);
        if($success) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    return NULL;
}

function buildParams(array $arr):?array {
    if(count($arr) == 0)
        return null;
    $params = [];
    foreach ($arr as $item) {
        array_push($params, $item);
    }
    return $params;
}

function addIdForMixePrimaryKey( string $sql, array $arr) :string {
    if(count($arr) <= 1)
        return $sql;
    for($i = 0; $i < count($arr) - 1; $i++) {
        $sql .= " " . $arr[$i]." = ? AND ";
    }
    $sql .= " " . $arr[$i]." = ?";
    return $sql;
}

function buildParamsForMixePrimaryKey(array $arr):?array {
    if(count($arr) == 0)
        return null;
    $params = [];
    foreach ($arr as $item) {
        array_push($params, intval($item));
    }
    return $params;
}

function dataBaseFindOneForMixePrimaryKey(string $sql, array $arrIds) :?array {
    $db = getDataBaseConnection();
    //echo   $sql;
    //print_r($arrIds);
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($arrIds);
        if($success) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            //echo "error";
            http_response_code(500);
        }
    }
    return NULL;
}


function flagation(int $num) {
    echo $num . " --------- " . "flag\n";
}


function buildsUpdateAndattributsForMixPRymariKeyTab(string $tabNameInDb, array $attributsToset, array $primKeys) :?string {
    $str = "UPDATE " . $tabNameInDb . " SET";
    foreach ($attributsToset as $item) {
        $str .= " " . $item . " = ?,";
    }
    $str = substr($str, 0, -1);
    $str .= " WHERE ";
    $i = 0;
    $size = count($primKeys);
    foreach ($primKeys as $item) {
        if($i == $size - 1) {
            $str .= $item . " = ?";
        } else {
            $str .= $item . " = ? AND ";
        }
        $i++;
    }
    //echo $str;
    return  $str;
}
function buildAttributArrayFromData(array $data,array $keysToSelect):?array {
    $attributToSet = [];
    if(count($data) <= 0 || count($keysToSelect) <= 0)
        return null;
    foreach ($data as $keyA => $valueA) {
        foreach ($keysToSelect as $item){
            if(strcmp($keyA,$item) == 0) {
                array_push($attributToSet, $item);
            }
        }
    }
    return $attributToSet;
}

$word = "fox";
$mystring = "The quick brown fox jumps over the lazy dog";













/*

function dataBaseInsert(PDO $connect, string $sql, array $params): ?string
{
    $statement = $connect->prepare($sql);
    if ($statement !== false) {
        $success = $statement->execute(params);
        if ($success) {
            return $connect->lastInsertId();
        }
    }
    return NULL;
}

function dataBaseFindOne(PDO $connect, string $sql, array $params): ?array
{
    $statement = $connect->prepare($sql);
    if ($statement !== false) {
        $success = $statement->execute(params);
        if ($success) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
    return NULL;
}

function dataBaseFindAll(PDO $connect, string $sql, array $params): ?array
{
    $statement = $connect->prepare($sql);
    if ($statement !== false) {
        $success = $statement->execute(params);
        if ($success) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    return NULL;

}*/
