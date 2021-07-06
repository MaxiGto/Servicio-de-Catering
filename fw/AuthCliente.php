<?php

if(!isset($_SESSION['auth'])){
    header("Location: login");
    exit;
}

if($_SESSION['rol'] != 'cliente'){
    header("Location: principal");
    exit;
}

?>