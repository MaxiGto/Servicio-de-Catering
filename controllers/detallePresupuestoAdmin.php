<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';

require '../views/DatosPresupuestoAdmin.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

$p = new Presupuestos();
$v = new DatosPresupuestoAdmin();

if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');
// if(!$p->verificarPresupuestoPendiente($_GET['id'])) die('Presupuesto no disponible');
$v->presupuesto = $p->getPresupuestoByID($_GET['id']);

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

$v->render();