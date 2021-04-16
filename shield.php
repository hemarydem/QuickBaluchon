<?php
    include("chckFnctns/chckFnctns.php");
    didYouConnect();
    if(!isset($_SESSION ['token'])) {
        $_SESSION ['token'] = tokenApi();
    }
    $content = file_get_contents('php://input');
    $data = json_decode($content, true);
    $tabArr = [
        1 => "bill",            // code = 1
        2 =>"CHECKDELIVERY",    // code = 2
        3 =>"coli",             // code = 3
        4 =>"CUSTOMERRATE",     // code = 4
        5 =>"DELIVERY",         // code = 5
        6 =>"DELIVERYOBJECTIF", // code = 6
        7 =>"DELIVERYRATE",     // code = 7
        8 =>"DEPOSIT",          // code = 8
        9 =>"DEPOT",            // code = 9
        10 =>"own",             // code = 10
        11 =>"paysheet",        // code = 11
        12 =>"recipient",       // code = 12
        13 =>"user",            // code = 13
        14 =>"vehicule"         // code = 14
    ];

    $urlBase = "http://localhost:8888/";

    $_SESSION["token"] = tokenApi();

    if(isset($data['type']) && ($data['type'] >= 1 && $data['type'] <= 5)) {                  //TODO reduce this code into a fuction
        $type = intval($data['type']);                                                          //warning "1B" will pass as 1
    } else {
        erro400NotConnectJsonMssg( "shield: TYPE is missing or the type's value is to hight, to little value");
    }
    unset($data['type']);
    if(!is_int($type))
        erro400NotConnectJsonMssg( "shield: TYPE must contain a number between 1 to 5");

    if(isset($data['code']) && ($data['code'] >= 1 && $data['code'] <= 14)) {
        $tab = $tabArr[intval($data['code'])];
    } else {
        erro400NotConnectJsonMssg( "shield: CODE is missing or the type's value is to hight, to little value");
    }
    unset($data['code']);
    areSetarr($data);
    checkStringsArray($data,1);
    switch ($type) {
        case 1:
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