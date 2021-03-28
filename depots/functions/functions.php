<?php
include ("./../../utils/db.php");
function insertDepot(string $tab, float $longitude, float $latitude, string $ville, string  $adresse, string  $codePostale) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO depot(longitude, latitude, ville, adresse, codePostale) VALUES (?,?,?,?,?)";
    $params = [$longitude, $latitude,  $ville,   $adresse,   $codePostale];
    return dataBaseInsert($db,  $sql, $params, $tab);
}

function updateUser( string $nom, string $prenom, string  $mail, string  $adresse, string $numSiret, string $password, string $tel, int $driverLicence, int $statut, int $busy, int $zoneMaxDef, int $id ) {
    $db = getDataBaseConnection();
    $sql = "UPDATE user SET nom = ?, prenom = ?, mail = ?, adresse = ?, numSiret = ?, password = ?, tel = ?, driverLicence = ?, statut = ?, busy = ?, zoneMaxDef = ? WHERE id=?";
    $params = [ $nom,  $prenom,   $mail,   $adresse,  $numSiret,  $password,  $tel, $driverLicence, $statut, $busy, $zoneMaxDef, $id];
    return dataBaseInsert($db,  $sql, $params);
}
