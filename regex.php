<?php
// wesh
echo "whesh";
$valueTrue = "1234567890123456";
$valueFalse = "123456789012345";

$resultTest1 = preg_match("/^\d{16}$/",$valueTrue);


$resultTest2 = preg_match("/^\d{16}$/",$valueFalse);

echo "resultTest1 = " . $resultTest1 ."\n";
echo "resultTest2 = " . $resultTest2 ."\n";

function tokenReqShield():string {
    $today = getdate();
    $tddate = strval($today["mday"]) . "/" . strval($today["mon"]) . "/" . strval($today["year"] ) .  "c > un peu tout en fait ? xoxo : xoxox　ありがと";
    $tddate = hash("sha512",$tddate,false);
    return $tddate;
}

function getUserStatus(int $id) {
    $_SESSION ['tokenApi'] = tokenReqShield();
    $urlBase = "http://localhost:8888/users/get/user.php?statut=1&id=$id";
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    //print_r($result);
    $result = json_decode($result, true);
    if(isset($result)) {
        print_r($result);
        unset($_SESSION['tokenApi']);
        return intval($result["statut"]);
    }
    erro400NotConnectJsonMssg( "shield: this id does not exist in data base");
}

echo getUserStatus(1555555);