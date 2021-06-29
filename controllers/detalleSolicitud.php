<?php

require '../fw/fw.php';

require '../models/Solicitudes.php';

require '../views/DatosSolicitud.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new DatosSolicitud();

$v->solicitud = $s->getSolicitudByID($_GET['id']);

$v->menus = $s->getMenusSolicitud($_GET['id']);
$v->cantidadMenus = $s->getTotalMenusSolicitud($_GET['id']);
$v->totalMenus = $s->getPrecioTotalMenusSolicitud($_GET['id']);

if($s->solicitudTieneServicios($_GET['id'])){
    $v->tieneServicios = true;
    $v->servicios = $s->getServiciosSolicitud($_GET['id']);
    $v->totalServicios = $s->getPrecioTotalServiciosSolicitud($_GET['id']);
} else{
    $v->tieneServicios = false;
}

$v->render();


