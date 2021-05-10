<?php
include ("./../../utils/db.php");
function insertDeliveryObjectif(string $tab, int $palier, int $idUser) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO DELIVERYOBJECTIF(palier, idUser) VALUES (?,?)";
    $params = [ $palier,  $idUser ];
    return dataBaseInsert($db,  $sql, $params, $tab);
}

