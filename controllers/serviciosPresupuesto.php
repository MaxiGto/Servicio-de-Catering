<?php

require '../fw/fw.php';
require '../fw/AuthCliente.php';

require '../models/Servicios.php';

require '../views/ServiciosPresupuesto.php';

if(!isset($_SESSION['menus'])){
    header("Location: menus-presupuesto");
    exit;
}

if(isset($_POST['servicios'])){

    $v = new ServiciosPresupuesto();
    $v->repetido = false;
    $v->sinServicios = false;

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

    foreach($_SESSION['servicios'] as $e){
        
        $v->serviciosSeleccionados[] = $s->getServicioById($e);

    }
    
    $v->servicios = $s->getTodos();
    $v->render();

} else {

    $_SESSION['servicios'] = array();
    $s = new Servicios();

    $v = new ServiciosPresupuesto();
    $v->servicios = $s->getTodos();
    $v->render();
}
