<?php

if(!isset($_SESSION['auth'])){
    header("Location: login");
    exit;
}

if($_SESSION['rol'] != 'encargado' &&  $_SESSION['rol'] != 'mozo') {
    header("Location: principal");
    exit;
}

?>