<?php

require '../fw/fw.php';

require '../models/Solicitudes.php';

require '../views/AgregarMenusSolicitud.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new AgregarMenusSolicitud();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');
$v->idSolicitud = $_GET['id'];

if(count($_POST) > 0){

    $s->saveMenuSolicitud($_GET['id'], $_POST['menu'], $_POST['cantidad']);
    $v->menus = $s->getMenusSolicitud($_GET['id']);
    $v->noMenus = $s->getMenusNotInSolicitud($_GET['id']);
    $v->render();

} else {
    $v->menus = $s->getMenusSolicitud($_GET['id']);
    $v->noMenus = $s->getMenusNotInSolicitud($_GET['id']);
    $v->render();
}

