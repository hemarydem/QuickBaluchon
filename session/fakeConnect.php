<?php
include("../chckFnctns/chckFnctns.php");
session_start();
$_SESSION ['token'] = tokenApi();
$_SESSION ['connection'] = true;
$_SESSION ['status'] = 1;
$_SESSION ['id'] = 1;
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