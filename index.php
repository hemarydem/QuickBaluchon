<?php
    $json = json_decode($_GET["json"], false);//on créer l'objet
    $pw = $json->{'pwd'};
    $json->{'pwd'} = hash('sha256', $pw);
    $file = fopen("connext.json", "w");
    $jsonStr = json_encode($json);// on revien en string { "id" : "remy" , "pwd" : "azerty" }
    fwrite($file,$jsonStr,strlen ($jsonStr));
    fclose($file);
 ?>
