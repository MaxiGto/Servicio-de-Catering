<?php

require '../fw/fw.php';

require '../models/Solicitudes.php';

require '../views/QuitarMenusSolicitud.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new QuitarMenusSolicitud();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');
$v->idSolicitud = $_GET['id'];

echo $s->getCantidadTiposMenusSolicitud($_GET['id']);