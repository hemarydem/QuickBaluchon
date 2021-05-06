<?php
    function checIfsessionStarted() {
        if(session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    function checkIfconnected(){
        if(!isset($_SESSION["id"])) {
            header("Location: http://localhost:8888/front/index.php");
        }
    }
    
    function checkRightToBeHere(int $status) {
        if(isset($_SESSION["status"])) {
            if($_SESSION["status"] != $status)
                header("Location: http://localhost:8888/front/index.php");
        }
    }
    
