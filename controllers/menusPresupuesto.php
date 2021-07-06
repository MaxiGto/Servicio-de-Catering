<?php

require '../fw/fw.php';

require '../models/Menus.php';

require '../views/MenusPresupuesto.php';

if(!isset($_SESSION['auth'])){
    header("Location: login");
    exit;
}

if($_SESSION['rol'] != 'cliente'){
    header("Location: principal");
    exit;
}

$hayMenu = true;

if(count($_POST) > 0 ){

    $hayMenu = false;

    foreach($_POST as $k => $v){
        if($v > 0) {
            $_SESSION['menus'][$k] = $v;
            $hayMenu = true;
        } 
    }

    if($hayMenu){
        header('Location: servicios-presupuesto');
        exit;
    } 
    
} 

$_SESSION['menus'] = array();
$m = new Menus();

$v = new MenusPresupuesto();
$v->menus = $m->getTodos();
if(!$hayMenu) $v->error = true;
$v->render();





