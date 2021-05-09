<?php
include ("env.php");
/* FILE EDITE BY:
 *                 - YANIS TAGRI
 *                 - PEROCHON LÉO
 *                 - HAMED Rémy
 * FILE purpose:
 * This file contain general functions who are calling or updating the data base
 * then, there is some functions for build and write SQL request
 */




/* getDataBaseConnection ()
 * this fonction get the connection with the data base
 */
/*function getDataBaseConnection(): PDO {
    $dsn = 'mysql:dbname=qb;host=localhost';
    $user = 'root';
    $password = 'root';
    try {
       return $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}*/

/* getDataBaseConnection ()
 * this fonction get the connection with the data base//TODO DELELTE FOR TEST
 */
function getDataBaseConnection(): PDO {
    $dsn = getenv('DSN');
    $user = getenv('USER');
    $password = getenv('PASSWORD');
    try {
        return $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}





/* dataBaseInsert ()
 *
 * Genereric function who do all the insert
 *
 * arguments
 * obj pdo
 * string who contains the sql request
 * array contening all the data for the data base
 * string who si the name of the tab
 *
 * return
 * integer id of the tab who was insert
 * or
 * Null
 */
function dataBaseInsert(PDO $connect, string $sql, array $params, string $tabName):?int {
    $statement = $connect->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            $id  = $connect->lastInsertId();
            header('Content-type: Application/json');
            echo json_encode(execRequest("SELECT * FROM ".$tabName." WHERE ID =?", [$id]));
            return $id;
        }else{
            header('Content-type: Application/json');
            echo json_encode(["message"=> "error data was not insert"]);
            exit(1);
        }
    }
    return NULL;
}

/* dataBaseInsertForMixePrimaryKey ()
 *
 * Genereric function who do all the insert For tab who have more than one line in thiere primary key
 *
 * arguments
 * obj pdo
 * string who contains the sql request
 * array contening all the data for the data base
 * string who si the name of the tab
 * array contenaing the ids for the primary key
 *
 * return
 * integer id of the tab who was insert
 * or
 * Null
 */

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
            $keys = buildParams($keyValues);
            header('Content-type: Application/json');
            $str = "SELECT * FROM ".$tabName.$str;
            echo json_encode(execRequest($str,$keys));
            return 0;
        }
    }
    return NULL;
}
/* execRequest ()
 *
 * Genereric function execute sql request
 * mostly use to get date from the data base
 *
 * arguments
 * string who contains the sql request
 * array contenains all the data for the data base
 *
 * return
 * array contening all the result of the call
 * or
 * Null
 */

function execRequest(string $sql, array $params):?array {
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
             $result = $statement->fetch(PDO::FETCH_ASSOC);
             if($result == false) {
                 header("Content-Type: application/json");
                 echo json_encode(["message"=> "result not found"]);
                 exit(1);
             } else {
                 return $result;
             }
        }
    }
    return NULL;
}
/* execRequestGetALLResults ()
 *
 * Genereric function execute sql request
 * mostly use to get date from the data base
 *
 * arguments
 * string who contains the sql request
 * array contenains all the data for the data base
 *
 * return
 * array contening all the result of the call
 * or
 * Null
 */

function execRequestGetALLResults(string $sql, array $params):?array {
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($result == false) {
                header("Content-Type: application/json");
                echo json_encode(["message"=> "result not found"]);
                exit(1);
            } else {
                return $result;
            }
        }
    }
    return NULL;
}

/* execRequestUpdate ()
 *
 * Genereric function execute UPDATE request
 *
 * arguments
 * string who contains the sql request
 * array contenains all the data for the data base
 *
 * return
 * integer  if success
 * or
 * Null for a fail
 */

function execRequestUpdate(string $sql, array $params):?int {
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

/* execRequestDelete ()
 *
 * Genereric function execute Delete request
 *
 * arguments
 * string who contains the sql request
 * array contenains all the data for the data base
 *
 * return
 * boolean  if success
 * or
 * Null for a fail
 */

function execRequestDelete(string $sql, array $params) :?bool {
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

/* buildsUpdateAndattributs ()
 * Genereric function who build an update sql request
 *
 * arguments
 * string who si the name of the tab
 * array contenain all the data for the data base
 *
 * return
 * string request sql
 * or
 * Null
 */

function buildsUpdateAndattributs(string $tabNameInDb, array $attributsToset) :?string {
    if(isset($attributsToset['id'])) {                          // must have an id
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
    return  $str;
}

/* buildsDelete ()
 * Genereric function who build an delete sql request
 *
 * arguments
 * string who si the name of the tab
 * array contenain all the data for the data base
 *
 * return
 * string request sql
 * or
 * Null
 */

function buildsDelete(string $tabNameInDb, int $id) :?string {
    if(is_int($id) ) {
        $sql = "DELETE FROM ".$tabNameInDb." WHERE id = ?";
    } else {
        http_response_code(500);
        return null;
    }
    return  $sql;
}

/* buildsDeleteForMixPRymariKeyTab ()
 * Genereric function who build an delete sql request
 *
 * arguments
 * string who si the name of the tab
 * array contenains all the data for the data base
 * array contenains ids of the line who must be delelete
 *
 * return
 * string request sql
 * or
 * Null
 */

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
/* dataBaseFindOne ()
 * Genereric function call the data base to get informations aboute one line
 *
 * arguments
 * string contenains sql request
 * int id of tab's line
 *
 * return
 * array contains request results
 * or
 * Null
 */


function dataBaseFindOne(string $sql, int $id) :?array {
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute([$id]);
        if($success) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result === false) {
                return NULL;
            }
            return $result;
        } else {
            http_response_code(500);
        }
    }
    return NULL;
}

/* buildParams ()
 * get datas from an array associative array to build
 * check if it's not empty
 * only keeping the data
 *
 * arguments
 *array
 *
 * return
 * array contains data
 * or
 * Null
 */


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

/* buildParamsForMixePrimaryKey ()
 * get datas from an array associative array to build
 * check if it's not empty
 * cast it in int
 *
 * arguments
 *array
 *
 * return
 * array contains data
 * or
 * Null
 */


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
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($arrIds);
        if($success) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            http_response_code(500);
        }
    }
    return NULL;
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

function isExistInDb(int $id, string $tab):bool {
    $idChecked = intval($id);
    $sql = "SELECT id FROM " . $tab . " WHERE id = ?";
    $arr = execCheckRequest($sql,[$idChecked]);
    if($arr != null && count($arr) > 0)
        return  true;
    echo "this id does not exist in data base";
    return false;
}

//dev tools

function flagation(int $num) {
    echo $num . " --------- " . "flag\n";
}

// testing fucntion

function execCheckRequest(string $sql, array $params):?array {
    $db = getDataBaseConnection();
    $statement = $db->prepare($sql);
    if($statement !== false) {
        $success = $statement->execute($params);
        if($success) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result === false)
                return NULL;
            return $result;
        }
    }
    return NULL;
}

