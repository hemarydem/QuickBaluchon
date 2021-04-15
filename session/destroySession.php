<?php
session_start();
if(session_status() == PHP_SESSION_ACTIVE)
    echo $_SESSION["toto"];
    session_unset();
    session_destroy();
echo "session détruite";
echo session_status();
