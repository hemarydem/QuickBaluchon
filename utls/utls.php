<?php
    function checIfsessionStarted() {
        if(session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    function checkIfconnected(){
        if(!isset($_SESSION["id_session"])) {
            header("Location: https://quickbaluchonservice.site/QuickBaluchon/index.php");
        }
    }
    
    function checkRightToBeHere(int $status) {
        if(isset($_SESSION["status_session"])) {
            if($_SESSION["status_session"] != $status)
                header("Location: https://quickbaluchonservice.site/QuickBaluchon/index.php");
        }
    }
    
