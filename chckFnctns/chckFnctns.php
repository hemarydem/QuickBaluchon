<?php
/*
 * countJsonObjElem
 * check there is all propertis are in the json bject
 */
function countJsonObjElem($jsonObj, $numOfElements) {
    if(count((array)$jsonObj) != $numOfElements) {// check all data are init
        http_response_code(400);
        exit(1);
    }
}
/*
 *  areSetJsonObjElem
 * check there is all propertis are init
 */
function areSetJsonObjElem($jsonObj) { //NOTE CALL  countJsonObjElem
    foreach ($jsonObj as $key => $value) {                     //Before areSetJsonObjElem()
        if(strlen($value) <= 0) {
            http_response_code(400);
            exit(1);
        }
    }
}
/*
 * strToIntJsonObjElem
 * cast elements whos the key in the array to integer
 */
function strToIntJsonObjElem($jsonObj,$arrayIntKeys) {
    foreach ($arrayIntKeys as $key => $value) {
        $jsonObj->{$value} = (int)$jsonObj->{$value};
    }
}

function initArrayForSqlReq($jsonObj):array {
    $array = [];
    $i = 0;
    foreach ($jsonObj as $key => $value) {
        $array[$i] = $value;
        $i++;
    }
    foreach ($array as $key => $value) {
        echo $value;
    }
    return $array;
}
/*
 * function to notice until where the code is running
 */
function codeIsRun($flag){
    echo "\n". $flag."\n";
}
