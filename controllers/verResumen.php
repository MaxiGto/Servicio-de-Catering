<?php

require '../fw/fw.php';
require '../fw/AuthCliente.php';

require '../models/Solicitudes.php';
require '../models/Menus.php';
require '../models/Servicios.php';
require '../models/Clientes.php';

require '../views/Resumen.php';
require '../views/PresupuestoOk.php';

if(!isset($_SESSION['id_cliente'])) die('No existe ID de cliente');

if(!isset($_SESSION['menus']) || !isset($_SESSION['servicios'])){
    header("Location: menus-presupuesto");
    exit;
}

$c = new Clientes();
if(!$c->verificarIDCliente($_SESSION['id_cliente'])) die('ID de cliente inválido');

if(count($_POST) > 0){

    $sct = new Solicitudes();
    $sct->saveSolicitud($_POST['comentario'], $_SESSION['id_cliente'], $_SESSION['menus'], $_SESSION['servicios']);
    $v = new PresupuestoOk();
    $v->render();

} else {
    $m = new Menus();

    $v = new Resumen();

    $v->menus = $m->getMenusEvento($_SESSION['menus']);

    if(count($_SESSION['servicios']) > 0){
        $s = new Servicios();
        $v->servicios = $s->getServiciosEvento($_SESSION['servicios']);
    } else {
        $v->sinServicios = true;
    }
   
    $v->render();
    }


