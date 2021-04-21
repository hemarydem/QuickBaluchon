<?php
    include("utils/db.php");
    include("chckFnctns/chckFnctns.php");
    checIfsessionStarted();
    $content = file_get_contents('php://input');
    $data = json_decode($content, true);
    //print_r($data);
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

    $type = valueIsInt($data,"type");
    $tab = valueIsInt($data,"code");
    unset($data['type']);
    unset($data['code']);
    //echo "id = " . $id;
    if($type == 1 && $tab == 13) {
        $status = 3;
        $jsonUserStatus = 3;
    } else {
        flagation(1);
        $id = valueIsInt($data,"jsonUserId");
        $jsonUserStatus = valueIsInt($data,"jsonUserStatus");
        unset($data['jsonUserStatus']);
        unset($data['jsonUserId']);
        $status = getUserStatus($id);

    }
    //echo $status;
    if($jsonUserStatus != $status)
        erro400NotConnectJsonMssg( "shield: error jsonUserstatus not good");
    $_SESSION ['tokenApi'] = tokenconnection($status);
    if(!is_int($type))
        erro400NotConnectJsonMssg( "shield: TYPE must contain a number between 1 to 5");
    if($type < 0 || $type > 5) {
        erro400NotConnectJsonMssg( "shield: the type's value is to hight, to little value");
    }
    if($tab < 0 && $tab > 14) {
        erro400NotConnectJsonMssg( "shield: the code's value is to hight, to little value");
    }
    $tab = $tabArr[$tab];
    areSetarr($data);
    checkStringsArray($data,1);
    $urlBase = "http://152.228.163.174/api/QuickBaluchon";
    $data ['tokenApi'] = $_SESSION['tokenApi'];
    //array_push($data,$_SESSION['tokenApi']);
    print_r($data);
    switch ($type) {
        case 1:
            $urlBase.= $tab ."s/post/creat.php";
            $ch = curl_init($urlBase);
            //$data ['tokenApi'] = $_SESSION['tokenApi'];
            $payload = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            header('Content-type: Application/json');
            print_r($result);
            unset($_SESSION['tokenApi']);
            break;
        case 2:
            $urlBase.= $tab ."s/post/update.php";
            $ch = curl_init($urlBase);
            $data ['tokenApi'] = $_SESSION['tokenApi'];
            $payload = json_encode($data);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            header('Content-type: Application/json');
            print_r($result);
            unset($_SESSION['tokenApi']);
            break;
        case 3:
            $urlBase.= $tab ."s/get/$tab.php?";
            foreach ($data as $key => $value) {
                $urlBase.=$key."=".$value."&";
            }
            $urlBase = substr($urlBase, 0, -1);
            $urlBase.="&tokenApi=".$_SESSION['tokenApi'];
            $cURLConnection = curl_init();
            curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($cURLConnection);
            curl_close($cURLConnection);
            header('Content-type: Application/json');
            print_r($result);
            unset($_SESSION['tokenApi']);
            break;
        case 4:
            $urlBase.= $tab ."s/get/list.php?";
            foreach ($data as $key => $value) {
                $urlBase.=$key."=".$value."&";
            }
            $urlBase = substr($urlBase, 0, -1);
            $urlBase.="&tokenApi=".$_SESSION['tokenApi'];
            $cURLConnection = curl_init();
            curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($cURLConnection);
            curl_close($cURLConnection);
            header('Content-type: Application/json');
            print_r($result);
            unset($_SESSION['tokenApi']);
            break;
        case 5:
            $urlBase.= $tab ."s/delete/delete.php?";
            foreach ($data as $key => $value) {
                $urlBase.=$key."=".$value."&";
            }
            $urlBase = substr($urlBase, 0, -1);
            $urlBase.="&tokenApi=".$_SESSION['tokenApi'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlBase);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            header('Content-type: Application/json');
            print_r($result);
            unset($_SESSION['tokenApi']);
            break;
        case 6:
            $urlBase.= $tab . "/getByAttribut/getByAttribut.php?";
            foreach ($data as $key => $value) {
                $urlBase.=$key."=".$value."&";
            }
            $urlBase = substr($urlBase, 0, -1);
            $urlBase.="&tokenApi=".$_SESSION['tokenApi'];
            $cURLConnection = curl_init();
            curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($cURLConnection);
            curl_close($cURLConnection);
            header('Content-type: Application/json');
            print_r($result);
            unset($_SESSION['tokenApi']);
            break;
    }
