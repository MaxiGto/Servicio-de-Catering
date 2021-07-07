<?php

require '../fw/fw.php';
require '../fw/AuthCliente.php';

require '../models/Presupuestos.php';

require '../views/DatosPresupuesto.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

$p = new Presupuestos();
$v = new DatosPresupuesto();

if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');
if(!$p->verificarPresupuestoCliente($_GET['id'], $_SESSION['id_cliente'])) die('No tiene permisos para acceder a esta página');
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