<?php

require '../fw/fw.php';

require '../models/Servicios.php';

require '../views/ServiciosPresupuesto.php';

if(count($_POST) > 0 ){

    $v = new ServiciosPresupuesto();
    $v->repetido = false;

    foreach($_SESSION['servicios'] as $e){
        
        if($_POST['servicios'] == $e){
            $v->repetido = true;
            $v->agregado = false;
        } 

    }

    if(!$v->repetido){
        $_SESSION['servicios'][] = $_POST['servicios'];
        $v->agregado = true;
    } 

    $s = new Servicios();
    
    $v->servicios = $s->getTodos();
    $v->render();

} else {

    $_SESSION['servicios'] = array();
    $s = new Servicios();

    $v = new ServiciosPresupuesto();
    $v->servicios = $s->getTodos();
    $v->render();
}
