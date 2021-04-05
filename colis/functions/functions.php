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
    int $idExpressCost): ?string {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO ".$tab."(dDate ,adresse, codePostale, recipientMail, weight, volume, sendingStatut, mode, idRecipient, idDelivery,idUser,idDepot,idCost,idExpressCost) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    //echo $sql;
    $params =  [$date, $adresse, $codePostale, $recipientMail,$weight, $volume, $sendingStatut, $mode, $idRecipient, $idDelivery, $idUser,$idDepot,$idCost,$idExpressCost];
    //print_r($params);
    return dataBaseInsert($db, $sql, $params, $tab);
}
