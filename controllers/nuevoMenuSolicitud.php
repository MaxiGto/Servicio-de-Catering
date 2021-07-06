<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Solicitudes.php';
require '../models/Menus.php';

require '../views/AgregarMenusSolicitud.php';


if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new AgregarMenusSolicitud();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');
$v->idSolicitud = $_GET['id'];

if(count($_POST) > 0){

    if(!isset($_POST['menu'])) die('No existe ID de menú');
    if(!isset($_POST['cantidad'])) die('No existe cantidad');

    $s->saveMenuSolicitud($_GET['id'], $_POST['menu'], $_POST['cantidad']);
    $v->menus = $s->getMenusSolicitud($_GET['id']);
    $v->noMenus = $s->getMenusNotInSolicitud($_GET['id']);
    $v->render();

} else {
    $v->menus = $s->getMenusSolicitud($_GET['id']);
    $v->noMenus = $s->getMenusNotInSolicitud($_GET['id']);
    $v->render();
}

