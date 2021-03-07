<?php
include ("./../../utils/db.php");
function insertRecipient( string $mail, string  $nom, string $prenom) :?string {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO recipient( mail, nom, prenom) VALUES (?,?,?)";
    $params = [ $mail,  $nom,   $prenom];
    return dataBaseInsert($db,  $sql, $params);
}