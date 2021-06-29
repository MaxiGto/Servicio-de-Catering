<?php

require '../fw/fw.php';

require '../models/Solicitudes.php';

require '../views/QuitarMenusSolicitud.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new QuitarMenusSolicitud();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');
$v->idSolicitud = $_GET['id'];

if(count($_POST) > 0){
    $s->eliminarMenuSolicitud($_GET['id'], $_POST['menu']);
    if($s->getCantidadTiposMenusSolicitud($_GET['id']) < 2) $v->minimo = true;
    $v->menus = $s->getMenusSolicitud($_GET['id']);
    $v->render();
} else {
    if($s->getCantidadTiposMenusSolicitud($_GET['id']) < 2) $v->minimo = true;
    $v->menus = $s->getMenusSolicitud($_GET['id']);
    $v->render();
}

