<?php
if(isset($_GET)){
/*
    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/colis/get/list.php?limit=1000&offset=0&isPayed=1&sendingStatut=1&id&adresse&codePostale&dDate=" . $_GET["date"] . "&idDepot=". $_GET["idDepot"];
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


    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchon/depots/get/depot.php?id=" . $_GET["idDepot"];
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $currentDepotArray = json_decode(curl_exec($cURLConnection), true);
    curl_close($cURLConnection);



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
        $stratPoint = "origins=" . $currentDepotArray["longitude"] . ",". $currentDepotArray["latitude"];
        $endPoint ="&destinations=" . $data[$key]["longitude"] . "," . $data[$key]["latitude"];
        $urlp2End = "&travelMode=driving&key=AvodcS2fiYqi1KDA7R1XZ-FQV2qEJKihfcFKfcpQrZwdWRCMLXDJ67WrQwRthFe8";
        $urlBase = "https://api-adresse.data.gouv.fr/search/?q=".$address."+".$data[$key]["codePostale"];
        //echo $urlBase;
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($cURLConnection), true);
        curl_close($cURLConnection);
        $data[$key]["gap"] =  $result["features"][0]["geometry"]["coordinates"][1];
    }*/
    $urlBase ="https://dev.virtualearth.net/REST/v1/Routes/DistanceMatrix?origins=48.892880582429321,2.1062883883451931&destinations=48.8480178,2.0556039&travelMode=driving&key=AvodcS2fiYqi1KDA7R1XZ-FQV2qEJKihfcFKfcpQrZwdWRCMLXDJ67WrQwRthFe8";
    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $urlBase);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($cURLConnection), true);
    curl_close($cURLConnection);
    print_r($result["resourceSets"]);
    print_r($result);
}


