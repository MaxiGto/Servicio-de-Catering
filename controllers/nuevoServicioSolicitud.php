<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Solicitudes.php';

require '../views/AgregarServiciosSolicitud.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new AgregarServiciosSolicitud();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');
$v->idSolicitud = $_GET['id'];

if(count($_POST) > 0){

    if(!isset($_POST['servicio'])) die('No existe ID de servicio');

    $s->saveServicioSolicitud($_GET['id'], $_POST['servicio']);
    if($s->solicitudTieneServicios($_GET['id'])) $v->tieneServicios = true;
    $v->servicios= $s->getServiciosSolicitud($_GET['id']);
    $v->noServicios = $s->getServiciosNotInSolicitud($_GET['id']);
    $v->render();

} else {
    if($s->solicitudTieneServicios($_GET['id'])) $v->tieneServicios = true;
    $v->servicios = $s->getServiciosSolicitud($_GET['id']);
    $v->noServicios = $s->getServiciosNotInSolicitud($_GET['id']);
    $v->render();
}

