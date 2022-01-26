<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Solicitudes.php';
require '../models/Presupuestos.php';

require '../views/PresupuestoEnviado.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');

$p = new Presupuestos();

$monto = $s->getPrecioTotalMenusSolicitud($_GET['id']);
$adicional = $s -> getPrecioTotalServiciosSolicitud($_GET['id']);
if($adicional['total_servicios'] == NULL) $adicional['total_servicios'] = 0;

$p->savePresupuesto($monto['total_menus'], $adicional['total_servicios'], $_POST['horasAdicionales'], $_POST['precioHorasAd'], $_POST['observaciones'], $_GET['id']);

$v = new PresupuestoEnviado();

$v->render();





