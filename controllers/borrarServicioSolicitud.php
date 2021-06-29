<?php

require '../fw/fw.php';

require '../models/Solicitudes.php';

require '../views/QuitarServiciosSolicitud.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new QuitarServiciosSolicitud();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');
$v->idSolicitud = $_GET['id'];

if(isset($_POST['servicio'])){
    $s->eliminarServicioSolicitud($_GET['id'], $_POST['servicio']);
    if($s->getCantidadTiposServiciosSolicitud($_GET['id']) > 0) {
        $v->servicios = $s->getServiciosSolicitud($_GET['id']);
    } else {
        $v->minimo = true;
    }
    
    $v->render();
} else {
    if($s->getCantidadTiposServiciosSolicitud($_GET['id']) > 0) {
        $v->servicios = $s->getServiciosSolicitud($_GET['id']);
    } else {
        $v->minimo = true;
    }
    
    $v->render();
}
