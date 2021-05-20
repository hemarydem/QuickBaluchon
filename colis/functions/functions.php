<?php
include("./../../utils/db.php");
function insertColis(
    string $tab,
    string $date,
    string $adresse,
    string $codePostale,
    string $recipientMail,
    int $weight,
    int $volume,
    int $sendingStatut,
    int $mode,
    int $idRecipient,
    int $idDelivery,
    int $idUser,
    int $idDepot,
    int $idCost,
    int $idExpressCost,
    int $indexPriority,
    int $isPayed,
    float $price): ?string {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO ".$tab."(dDate ,adresse, codePostale, recipientMail, weight, volume, sendingStatut, mode, idRecipient, idDelivery,idUser,idDepot,idCost,idExpressCost,indexPriority, isPayed, price) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    //echo $sql;
    $params =  [$date, $adresse, $codePostale, $recipientMail,$weight, $volume, $sendingStatut, $mode, $idRecipient, $idDelivery, $idUser,$idDepot,$idCost,$idExpressCost,$indexPriority,$isPayed,$price];
    //print_r($params);
    return dataBaseInsert($db, $sql, $params, $tab);
}
