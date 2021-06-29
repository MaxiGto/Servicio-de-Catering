<?php

require '../fw/fw.php';

require '../models/Menus.php';

require '../views/MenusPresupuesto.php';

if(count($_POST) > 0 ){

    foreach($_POST as $k => $v){
        if($v > 0) $_SESSION['menus'][$k] = $v;
    }

    header('Location: servicios-presupuesto');
    exit;
} 

$_SESSION['menus'] = array();
$m = new Menus();

$v = new MenusPresupuesto();
$v->menus = $m->getTodos();
$v->render();





