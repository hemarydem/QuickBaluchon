<?php
include ("./../../utils/db.php");
function insertCheckdelivery(int $idDelivery, int $idUser) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO checkdelivery(idDelivery, idUser) VALUES (?,?)";
    $params = [ $idDelivery,  $idUser];
    return dataBaseInsert($db,  $sql, $params);
}

