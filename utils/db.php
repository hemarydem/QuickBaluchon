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
            echo $str;
            exit(1);
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
/*
function buildsSelectAndattributs(string $tabNameInDb, array $attributsToset) :?string {
    if(isset($attributsToset['id'])) {
        $id = intval($attributsToset['id']);
        unset($attributsToset['id']);
    } else {
        http_response_code(500);
        return null;
    }
    $str = "SELECT " . $tabNameInDb . " FROM";
    foreach ($attributsToset as $key => $value) {
        $str .= " " . $key . " = ?,";
    }
    $str = substr($str, 0, -1);
    //$str .= " WHERE id =" . $id;
    echo $str;
    return  $str;
}*/

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


function flagation(int $num) {
    echo $num . " --------- " . "flag\n";
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
