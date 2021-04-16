<?php
include("../chckFnctns/chckFnctns.php");
session_start();

$today = getdate();
$tddate = strval($today["mday"]) . "/" . strval($today["mon"]) . "/" . strval($today["year"] . "driver");
$tddate = hash("sha512",$tddate,false);

$_SESSION ["token"] = $tddate;
$_SESSION ["connect"] =  hash("sha512","1",false);
$_SESSION ["status"] = 1;
echo session_status();
echo "\n";
print_r($_SESSION);

/*
The solution is to do this after each time you do a session_start() :

<?php

if (ini_get('register_globals'))
{
    foreach ($_SESSION as $key=>$value)
    {
        if (isset($GLOBALS[$key]))
            unset($GLOBALS[$key]);
    }
}

*/