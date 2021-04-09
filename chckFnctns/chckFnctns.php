<?php
/* FILE EDITE BY:
 *                 - YANIS TAGRI
 *                 - PEROCHON LÉO
 *                 - HAMED Rémy
 * FILE purpose:
 * This file contain general functions who are calling or updating the data base
 * then, there is some functions for build and write SQL request
 */

/*
 * countJsonObjElem
 * check there is all propertis are in the json bject
 *
 *
 * arguments
 * $jsonObj
 * a jsonObj or an array
 *
 */


function countJsonObjElem($jsonObj,int $numOfElements) {
    if(count((array)$jsonObj) != $numOfElements) {// check all data are init
        //echo "countJsonObjElem";
        http_response_code(400);
        exit(1);
    }
}
/*
 * countArrElem
 * check data are in the array
 * arguments
 *  an array
 *
 */
function countArrElem(array $arr, int $numOfElements) {
    if(count($arr) != $numOfElements) {// check all data are init
        //echo "countJsonObjElem";
        http_response_code(400);
        exit(1);
    }
}
/*
 *  areSetJsonObjElem
 *  check there is all propertis are init
 */
function areSetJsonObjElem($jsonObj) { //NOTE CALL  countJsonObjElem
    foreach ($jsonObj as $key => $value) {                     //Before areSetJsonObjElem()
        if(strlen($value) <= 0) {
            //echo "areSetJsonObjElem";
            http_response_code(400);
            exit(1);
        }
    }
}
function areSetarr($jsonObj) { //NOTE CALL  countJsonObjElem
    foreach ($jsonObj as $key => $value) {                     //Before areSetJsonObjElem()
        if(strlen($value) <= 0) {
            //echo "areSetJsonObjElem";
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
function strToIntJsonArray(array $arr, $arrayIntKeys) {
    foreach ($arrayIntKeys as $key => $value) {
        $arr[$value] = (int)$arr[$value];
    }
    return $arr;
}

function ArrayOfstrToIntJsonObjElem($arrayIntKeys) { //all elements in integer
    foreach ($arrayIntKeys as $items)
        $items = intval($items);
    return $arrayIntKeys;
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

function strToIntAssiArrayElem($arr,$arrayIntKeys) {
    foreach ($arrayIntKeys as $key => $value) {
        if(isset($arr[$value]))
            $arr[$value] = intval($arr[$value]);
    }
}

function isInString(string $str, array $arr):bool {
    foreach ($arr as $item)
        if(strpos($str, $item) !== false) {
            return true; //word found
        } else {
            return false;
        }
}

function checkStringsArray(array $arr, int $option):bool { // option 0 if keys are integer
    $ref = ["SELECT", "select","UPDATE", "update", "DROP", "drop", "INSERT", "insert", "DELETE","delete"];
    foreach ($arr as $key => $value) {                     //or one if keys are strings
        if(isInString($value,$ref)) {
            http_response_code(400);
            exit(1);
        }
    }
    if ($option == 1) {
        foreach ($arr as $key => $value)
            if(isInString($key,$ref)) {
                http_response_code(400);
                exit(1);
            }
    }
    return true;
}
/*
 * function to notice until where the code is running
 */
function codeIsRun($flag){
    echo "\n". $flag."\n";
}

