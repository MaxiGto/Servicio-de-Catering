<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Solicitudes.php';

require '../views/DatosSolicitud.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new DatosSolicitud();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');
if($s->solicitudPresupuestada($_GET['id'])) die('Solicitud no disponible');
$v->solicitud = $s->getSolicitudByID($_GET['id']);

if(isset($_SESSION['horasAdicionales']) && isset($_SESSION['precioHorasAd'])){
    $v->horasAdicionales = true;
    $v->cantidadHoras = $_SESSION['horasAdicionales'];
    $v->precioHora = $_SESSION['precioHorasAd'];
}

$v->menus = $s->getMenusSolicitud($_GET['id']);
$v->cantidadMenus = $s->getTotalMenusSolicitud($_GET['id']);
$v->totalMenus = $s->getPrecioTotalMenusSolicitud($_GET['id']);

if($s->solicitudTieneServicios($_GET['id'])){
    $v->tieneServicios = true;
    $v->servicios = $s->getServiciosSolicitud($_GET['id']);
    $v->totalServicios = $s->getPrecioTotalServiciosSolicitud($_GET['id'])['total_servicios'];
} else{
    $v->tieneServicios = false;
}

$v->comentario = trim($v->solicitud['comentario']);

$v->render();

unset($_SESSION['horasAdicionales']);
unset($_SESSION['precioHorasAd']);


