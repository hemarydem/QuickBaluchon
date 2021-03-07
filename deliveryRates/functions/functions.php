<?php
include ("./../../utils/db.php");
function insertDeliveryRates(int $costByKm, int $costByColis, int  $primeWeight, int $idUser) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO deliveryrate(costByKm, costByColis, primeWeight, idUser) VALUES (?,?,?,?)";
    $params = [ $costByKm,  $costByColis,   $primeWeight, $idUser];
    return dataBaseInsert($db,  $sql, $params);
}

