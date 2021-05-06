<?php
session_start();
if(isset($_COOKIE))
    print_r($_COOKIE);

if(isset($_SESSION))
    print_r($_SESSION);
