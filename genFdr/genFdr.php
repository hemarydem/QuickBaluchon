<?php
if(isset($_GET)){
    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/list.php?limit=1000&offset=0&isPayed=1&sendingStatut=1&id&adresse&weight&volume&codePostale&dDate=" . $_GET["date"] . "&idDepot=". $_GET["idDepot"];
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $data = json_decode(curl_exec($cURLConnection), true);
    curl_close($cURLConnection);

    foreach ($data as $key => $value ){
        $data[$key]["longitude"] = 0;
        $data[$key]["latitude"] = 0;
        $data[$key]["gap"] = 0;
    }
    unset($data[4]);
    echo "LES COLIS";
    print_r($data);


    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/depots/get/depot.php?id=" . $_GET["idDepot"];
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $currentDepotArray = json_decode(curl_exec($cURLConnection), true);
    curl_close($cURLConnection);
    echo "LE Depot \n";
    print_r($data);


    foreach ($data as $key => $value ){
        $address = str_replace('\'', '',  $data[$key]["adresse"]);
        $address = str_replace(' ', '+',  $address);
        $urlBase = "https://api-adresse.data.gouv.fr/search/?q=".$address."+".$data[$key]["codePostale"];
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($cURLConnection), true);
        curl_close($cURLConnection);
        $data[$key]["longitude"] = $result["features"][0]["geometry"]["coordinates"][0];
        $data[$key]["latitude"] =  $result["features"][0]["geometry"]["coordinates"][1];
    }

    foreach ($data as $key => $value ) {
        $urlp1 = "https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?";
        $stratPoint = "origins=" . $currentDepotArray["latitude"] . ",". $currentDepotArray["longitude"];
        $endPoint ="&destinations=" .$data[$key]["latitude"]  . "," . $data[$key]["longitude"];
        $urlp2End = "&travelMode=driving&key=AvodcS2fiYqi1KDA7R1XZ-FQV2qEJKihfcFKfcpQrZwdWRCMLXDJ67WrQwRthFe8";
        $urlBase = $urlp1 . $stratPoint . $endPoint . $urlp2End ;
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $result2 = json_decode(curl_exec($cURLConnection), true);
        curl_close($cURLConnection);
        $data[$key]["gap"] = $result2["resourceSets"][0]["resources"][0]["results"][0]["travelDistance"];
    }


    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/vehicules/get/getCarsByUsed.php?id=".$_GET["id"];
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $vehicule = json_decode(curl_exec($cURLConnection), true);
    curl_close($cURLConnection);
    /*    $vehicule
     *
     *Array(
            [0] => Array
                (
                [id] => 59
                [imatriculation] => az-ert-y
                [nbColis] => 100
                [volumeMax] => 10
                [weightMax] => 500
                [employ] => 1
     )
    )
     *
     * */
    //print_r($vehicule);
    //$strTocreatDelyvery = "{\"volume\":\"" . $vehicule[0]["volumeMax"] . "\",\"weight\":\"" . $vehicule[0]["weightMax"] . "\",\"distance\":\"0\"}";
    $strTocreatDelyvery = [
        "volume"=> $vehicule[0]["volumeMax"],
        "weight"=> $vehicule[0]["weightMax"],
        "distance"=>0
    ];
    $strTocreatDelyvery = json_encode($strTocreatDelyvery);
    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/deliverys/post/creat.php";
    $ch = curl_init($urlBase);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $strTocreatDelyvery);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $dataDelyvery = json_decode(curl_exec($ch),true);
    curl_close($ch);

    //print_r($dataDelyvery);

    $strTocreatDelyveryCheck = [
        "idDelivery"=> $dataDelyvery["id"],
        "idUser"=> $_GET["id"]
    ];
    $strTocreatDelyveryCheck = json_encode($strTocreatDelyveryCheck);
    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/checkDeliverys/post/creat.php";
    $ch = curl_init($urlBase);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $strTocreatDelyveryCheck);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($ch),true);
    curl_close($ch);

    echo "Création de la liveraison";
    print_r($result);
/*
 * Array
(
[idDelivery] => 10
[idUser] => 119
)
 */

    $idColisTOset = 0;
    $min = 1000000;
    $heavy = 0;
    $lastLong = 0.0;
    $lastLati = 0.0;
    $dotelet = 0;
    $nextHeavy =0;

   foreach ($data as $key => $value) {
       if($data[$key]["gap"] < $min) {
           $min = $data[$key]["gap"];
           $idColisTOset = $data[$key]["id"];
           $heavy = $data[$key]["volume"];
           $lastLong =  $data[$key]["longitude"];
           $lastLati = $data[$key]["latitude"];
           $dotelet = $key;
       }
    }
    $firstColus = [
        "idDelivery"=> $dataDelyvery["id"],
        "idUser"=> $idColisTOset
    ];
    $firstColus = json_encode($firstColus);
    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/colis/post/update.php";
    $ch = curl_init($urlBase);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $firstColus);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($ch),true);
    curl_close($ch);
    print_r($data);
    unset($data[$dotelet]);

    while($heavy <  $vehicule[0]["weightMax"] ) {

        foreach ($data as $key => $value ) {
            $urlp1 = "https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?";
            $stratPoint = "origins=" . $lastLati . ",". $lastLong;
            $endPoint ="&destinations=" .$data[$key]["latitude"]  . "," . $data[$key]["longitude"];
            $urlp2End = "&travelMode=driving&key=AvodcS2fiYqi1KDA7R1XZ-FQV2qEJKihfcFKfcpQrZwdWRCMLXDJ67WrQwRthFe8";
            $urlBase = $urlp1 . $stratPoint . $endPoint . $urlp2End ;
            $cURLConnection = curl_init();
            curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
            $result2 = json_decode(curl_exec($cURLConnection), true);
            curl_close($cURLConnection);
            $data[$key]["gap"] = $result2["resourceSets"][0]["resources"][0]["results"][0]["travelDistance"];
        }

        $min = 1000000;
        foreach ($data as $key => $value) {
            if($data[$key]["gap"] < $min) {
                $min = $data[$key]["gap"];
                $idColisTOset = $data[$key]["id"];
                $nextHeavy = $data[$key]["volume"];
                $lastLong =  $data[$key]["longitude"];
                $lastLati = $data[$key]["latitude"];
                $dotelet = $key;
            }
        }

        $firstColus = [
            "idDelivery"=> $dataDelyvery["id"],
            "id"=> $idColisTOset
        ];
        $firstColus = json_encode($firstColus);
        $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/colis/post/update.php";
        $ch = curl_init($urlBase);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $firstColus);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch),true);
        curl_close($ch);
        echo"COLIS ajouter";
        print_r($result);

        $firstColus = [
            "idDelivery"=> $dataDelyvery["id"],
            "id"=> $idColisTOset
        ];
        $firstColus = json_encode($firstColus);
        $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/colis/post/update.php";
        $ch = curl_init($urlBase);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $firstColus);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch),true);
        curl_close($ch);
        print_r($data);
        unset($data[$dotelet]);
        $heavy += $nextHeavy;
    }

}


