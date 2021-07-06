<?php

if(!isset($_SESSION['auth'])){
    header("Location: login");
    exit;
}

if($_SESSION['rol'] != 'admin'){
    header("Location: principal");
    exit;
}

?>