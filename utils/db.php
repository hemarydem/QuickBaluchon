<?php

//'mysql:host=localhost;dbname=sananair;port=8889;charset=utf8', 'jo','r626wst100'
function getDataBaseConnection(): PDO {
    //sConnect to a MySQL database using driver invocation
    $dsn = 'mysql:dbname=qb;host=localhost';
    $user = 'remy';
    $password = 'azerty';

    try {
       return $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}


function dataBaseInsert(PDO $connect, string $sql, array $params) {
    $statement = $connect->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            return $connect->lastInsertId();
        }
    }
    return NULL;
}

function buildsUpdateAndattributs(string $tabNameInDb, array $attributsToset) {
    if(isset($attributsToset['id'])) {
        $id = intval($attributsToset['id']);
        unset($attributsToset['id']);
    } else {
        http_response_code(500);
        return null;
    }
    $str = "UPDATE " . $tabNameInDb . " SET";
    foreach ($tab as $key => $value) {
        $str .= " " . $key . " = ?,";
    }
    $str = substr($str, 0, -1);
    $str .= " WHERE id =" . $id;
    echo $str;
    return  $str;
}

function execRequest(string $sql, array $params) {
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            return $db->lastInsertId();
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
            return $success;
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