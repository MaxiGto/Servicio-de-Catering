<?php

require '../fw/fw.php';

require '../models/Solicitudes.php';
require '../models/Menus.php';
require '../models/Servicios.php';

require '../views/Resumen.php';
require '../views/PresupuestoOk.php';

if(count($_POST) > 0){

    $sct = new Solicitudes();
    $sct->saveSolicitud($_POST['comentario'], $_SESSION['id_cliente'], $_SESSION['menus'], $_SESSION['servicios']);
    $v = new PresupuestoOk();
    $v->render();

} else {
    $m = new Menus();
    $s = new Servicios();

    $v = new Resumen();
    $v->menus = $m->getMenusEvento($_SESSION['menus']);
    $v->servicios = $s->getServiciosEvento($_SESSION['servicios']);
    $v->render();
    }


