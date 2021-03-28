<?php
include ("./../../utils/db.php");
function insertRecipient(string $tabName,string $mail, string  $nom, string $prenom) :?string {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO recipient( mail, nom, prenom) VALUES (?,?,?)";
    $params = [ $mail,  $nom,   $prenom];
    return dataBaseInsert($db,  $sql, $params, $tabName);
}

function updateUser(string $mail, string  $nom, string $prenom, int $id ) {
    $db = getDataBaseConnection();
    $sql = "UPDATE recipient SET mail = ?, nom = ?, prenom = ? WHERE id=?";
    $params = [$mail,  $nom,   $prenom, $id];
    return dataBaseInsert($db,  $sql, $params);
}
