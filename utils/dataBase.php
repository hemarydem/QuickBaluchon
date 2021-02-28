<?php
function getDataBaseConnection():PDO {
  $dbname = "qbst";
  $port = "3306";
  $user = "root";
  $pwd = "root";
  $host = "localhost";
  return $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=$port;charset=utf8",$user,$pwd);
}





//'mysql:host=localhost;dbname=sananair;port=8889;charset=utf8', 'jo','r626wst100'
//new PDO('mysql:host=localhost;dbname=sananair;port=8889;charset=utf8', 'jo','r626wst100',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//$pdo = new PDO ("mysql:host=localhost;dbname=qbst;port=3306;charset=utf8", "root", "root");


?>
