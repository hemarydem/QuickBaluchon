<?php
include ("./../../utils/db.php");
function insertDeliveryObjectif(int $palier, int $idUser) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO deliveryobjectif(palier, idUser) VALUES (?,?)";
    $params = [ $palier,  $idUser ];
    return dataBaseInsert($db,  $sql, $params);
}

