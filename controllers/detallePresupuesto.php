<?php

require '../fw/fw.php';
require '../fw/AuthCliente.php';

require '../models/Presupuestos.php';
require '../models/Solicitudes.php';

require '../views/DatosPresupuesto.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');
if(!isset($_SESSION['id_cliente'])) die('No existe ID de cliente');

$p = new Presupuestos();
$s = new Solicitudes();
$v = new DatosPresupuesto();

if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');
if(!$p->verificarPresupuestoCliente($_GET['id'], $_SESSION['id_cliente'])) die('No tiene permisos para acceder a esta página');
if(!$p->verificarPresupuestoPendiente($_GET['id'])) die('Presupuesto no disponible');
$v->presupuesto = $p->getPresupuestoByID($_GET['id']);
$v->solicitud = $s->getSolicitudByID($v->presupuesto['id_solicitud']);

$v->menus = $p->getMenusPresupuesto($_GET['id']);
$v->cantidadMenus = $p->getTotalMenusPresupuesto($_GET['id']);
$v->totalMenus = $p->getPrecioTotalMenusPresupuesto($_GET['id']);

if($p->presupuestoTieneServicios($_GET['id'])){
    $v->tieneServicios = true;
    $v->servicios = $p->getServiciosPresupuesto($_GET['id']);
    $v->totalServicios = $p->getPrecioTotalServiciosPresupuesto($_GET['id']);
} else{
    $v->tieneServicios = false;
}

if($v->presupuesto['horasAd'] > 0){
    $v->tieneHorasAd = true;
    $v->cantidadHoras = $v->presupuesto['horasAd'];
    $v->precioHora = $v->presupuesto['precio_horasAd'];
}

$v->render();