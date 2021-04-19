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
 * tokenApi
 * gen the token api
 *
 * arguments
 * nothing
 *
 * return
 * string
 *
 */



function tokenconnection(int $userStatus):string {
    $today = getdate();
    $arrStatus = [
        1 => "driver",
        2 => "admin",
        3 => "client"
    ];
    $salt = $arrStatus[$userStatus];
    $tddate = strval($today["mday"]) . "/" . strval($today["mon"]) . "/" . strval($today["year"] ) .  $salt;
    $tddate = hash("sha512",$tddate,false);
    return $tddate;
}

function tokenReqShield():string {
    $today = getdate();
    $tddate = strval($today["mday"]) . "/" . strval($today["mon"]) . "/" . strval($today["year"] ) ."c > un peu tout en fait ? xoxo : xoxox　ありがと";
    $tddate = hash("sha512",$tddate,false);
    return $tddate;
}


function getUserStatus(int $id) {
    $result = execRequest("SELECT statut FROM USER WHERE id = ?",[$id]);
    if(isset($result["statut"])) {
        return intval($result["statut"]);
    }
    erro400NotConnectJsonMssg( "shield: this id does not exist in data base");
}

/*
 *
 *
 */

function chekIfRequestFromShield(string $token) {
    $clientToken = tokenconnection(1);
    $adminToken = tokenconnection(2);
    $driverToken = tokenconnection(3);
    $arr = [$clientToken, $adminToken, $driverToken];
    foreach ($arr as $item) {
        if(strcmp($token, $item) != 0)
            return true;
    }
    erro400NotConnectJsonMssg("bad token");
}


function checIfsessionStarted() {
    if(session_status() !== PHP_SESSION_ACTIVE)
        session_start();
}



function checkStatus(int $status) {
    $valid = true;
    if ($status < 0 || $status > 3) {
        $valid = false;
    }
    if(!$valid)
        erro400NotConnectJsonMssg( " 4 error: status you must be connected to access to this script");
}

/*
 * didYouConnect
 * checkIf the user sign in
 *
 * */
function didYouConnect() {

    echo session_status() . "\n";
    print_r($_SESSION);

    //if(!isset($_SESSION["connect"]))
      //  erro400NotConnectJsonMssg( "didYouConnect() 1 error: you must be connected to access to this script");

    //if(strcmp($_SESSION["connect"], hash("sha512","1",false)) != 0)
     //   erro400NotConnectJsonMssg( "didYouConnect() 2 error: you must be connected to access to this script");

    //if(isset($_SESSION["token"]))
    //    gotToken($_SESSION["token"]);

}



/*function errologToFILE(string $mssgError, string $pathToFILE) { // TODO log function
    file_put_contents(,$mssgError,)
    $File = $pathToFILE;
    $fh = fopen($myFile, 'w') or die("can't open file");
    $stringData = "Bobby Bopper\n";
    fwrite($fh, $stringData);
    $stringData = "Tracy Tanner\n";
    fwrite($fh, $stringData);
    fclose($fh);
}*/

function valueIsInt(array $arr, string $KyeOfValueToCheck):int {
    if(isset($arr[$KyeOfValueToCheck])) {                  //TODO reduce this code into a fuction
        $type = intval($arr[$KyeOfValueToCheck]);                                                          //warning "1B" will pass as 1
    } else {
        erro400NotConnectJsonMssg( "shield: ". $KyeOfValueToCheck . " is missing or the type's value is to hight, to little value");
    }
    return $type;
}

/*
 *  erro400NotConnectJsonMssg
 *
 *  error 400 http
 *  display json
 *  stop the screen
 * */
function erro400NotConnectJsonMssg( string $errorMessage) {
    http_response_code(400);
    header("Content-Type: application/json");
    echo json_encode(["message"=> $errorMessage]);
    exit(1);
}

function chkSessionStarted(){
    if(!isset($_SESSION) || session_status() !== PHP_SESSION_ACTIVE)
        erro400NotConnectJsonMssg("chkFnctns -> chkSessionStarted()\n error_session:unactive session");
}
function chkSession():boolean {
    chkSessionStarted();
    if (!isset($_SESSION["status"]) || $_SESSION ['token'] || $_SESSION ['status']) {
        erro400NotConnectJsonMssg("chkFnctns -> chkSession()\n error_session: you must be connect");
        return false;
    }
    return  true;
}
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
        erro400NotConnectJsonMssg( "warning : it miss some elements");
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
        erro400NotConnectJsonMssg( "warning : it miss some elements");
    }
}
/*
 *  areSetJsonObjElem
 *  check there is all propertis are init
 */
function areSetJsonObjElem($jsonObj) { //NOTE CALL  countJsonObjElem
    foreach ($jsonObj as $key => $value) {                     //Before areSetJsonObjElem()
        if(strlen($value) <= 0) {
            erro400NotConnectJsonMssg( "warning : field ".$key." is empty");
        }
    }
}
function areSetarr(array $arr) { //NOTE CALL  countJsonObjElem
    foreach ($arr as $key => $value) {                     //Before areSetJsonObjElem()
        if(strlen($value) <= 0) {
            erro400NotConnectJsonMssg( "warning : field ".$key." is empty");
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
    return $arr;
}

/* chek if the stings in the array arr
 * are in the string str
 *
 * arguments
 * str -> string you want check
 * arr -> the array it contains forbidens words in strings
 *
 * return
 * a boolean
 * true if their is no matche
 * */

function checkStringsArray(array $arr, int $option) { // option 0 if keys are integer
    $ref = ["SELECT", "select","UPDATE", "update", "DROP", "drop", "INSERT", "insert", "DELETE","delete"];
    foreach ($arr as $key => $value) {
            if(preg_match("/[Ss][eE][Ll][eE][cC][tT]|[Uu][Pp][Dd][Aa][Tt][Ee]|[Dd][Rr][Oo][Pp]|[Ii][Nn][Ss][Ee][Rr][Tt]|[Dd][eE][lL][eE][Tt][Ee]/",$value) != 0) {
                erro400NotConnectJsonMssg( "warning : THOSE NEXT WORDS ARE FORBBIDEN SELECT UPDATE DROP INSERT DELETE");
            }
    }
    if ($option == 1) {
        foreach ($arr as $key => $value)
            if(preg_match("/[Ss][eE][Ll][eE][cC][tT]|[Uu][Pp][Dd][Aa][Tt][Ee]|[Dd][Rr][Oo][Pp]|[Ii][Nn][Ss][Ee][Rr][Tt]|[Dd][eE][lL][eE][Tt][Ee]/",$value) != 0) {
                erro400NotConnectJsonMssg( "warning : THOSE NEXT WORDS ARE FORBBIDEN SELECT select UPDATE update DROP drop INSERT insert DELETE delete");
            }
    }
    return true;
}
/*
 * allElementsAreString
 * check if all select elements are strings
 *
 * argument
 * array -> $tab is the array checked
 * array -> $listOFvaluesMustBeStrings contains elements keys selected to be checked
 *
 * return
 * boolean true if select elements are strings
 * */

function allElementsAreString(array $tab, array $listOFvalusMustBeStrings):bool {
    foreach ($listOFvalusMustBeStrings as $item){
        if(!is_string($tab[$item]))
            return false;
    }
    return true;
}

/*
 * function to notice until where the code is running
 */
function codeIsRun($flag){
    echo "\n". $flag."\n";
}

