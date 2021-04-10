<?php
$content = file_get_contents('php://input');
$data = json_decode($content, true);
$tabArr = [
    1  => "bill",            // code = 1
    2  =>"CHECKDELIVERY",    // code = 2
    3 =>"coli",             // code = 3
    4 =>"CUSTOMERRATE",     // code = 4
    5 =>"DELIVERY",         // code = 5
    6 =>"DELIVERYOBJECTIF", // code = 6
    7 =>"DELIVERYRATE",     // code = 7
    8 =>"DEPOSIT",          // code = 8
    9 =>"DEPOT",            // code = 9
    10 =>"OWN",              // code = 10
    11 =>"PAYSHEET",         // code = 11
    12 =>"RECIPIENT",        // code = 12
    13 =>"user",             // code = 13
    14 =>"VEHICULE"          // code = 14
];
if(isset($data['type']) && ($data['type'] >= 1 && $data['type'] <= 14 )) {
    $type = intval($data['type']);
    $urlBase = "http://localhost:8888/";
} else {
    http_response_code(400);
    exit(1);
}
switch ($type) {
    case 1:
        unset($data['type']);
        $tab = $tabArr[intval($data['code'])];
        unset($data['code']);
        $urlBase.= $tab ."s/post/creat.php";
        $ch = curl_init($urlBase);
        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        header('Content-type: Application/json');
        print_r($result);
        break;
    case 2:
        unset($data['type']);
        $tab = $tabArr[intval($data['code'])];
        unset($data['code']);
        $urlBase.= $tab ."s/post/update.php";
        $ch = curl_init($urlBase);
        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        header('Content-type: Application/json');
        print_r($result);
        break;
    case 3:
        unset($data['type']);
        $tab = $tabArr[intval($data['code'])];
        unset($data['code']);
        $urlBase.= $tab ."s/get/$tab.php?";
        foreach ($data as $key => $value) {
            $urlBase.=$key."=".$value."&";
        }
        $urlBase = substr($urlBase, 0, -1);
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        header('Content-type: Application/json');
        print_r($result);
        break;
    case 4:
        unset($data['type']);
        $tab = $tabArr[intval($data['code'])];
        unset($data['code']);
        $urlBase.= $tab ."s/get/list.php?";
        foreach ($data as $key => $value) {
            $urlBase.=$key."=".$value."&";
        }
        $urlBase = substr($urlBase, 0, -1);
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        header('Content-type: Application/json');
        print_r($result);
        break;
    case 5:
        unset($data['type']);
        $tab = $tabArr[intval($data['code'])];
        unset($data['code']);
        $urlBase.= $tab ."s/delete/delete.php?";
        foreach ($data as $key => $value) {
            $urlBase.=$key."=".$value."&";
        }
        $urlBase = substr($urlBase, 0, -1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlBase);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        header('Content-type: Application/json');
        print_r($result);
        break;
}