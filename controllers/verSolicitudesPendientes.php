<?php

require '../fw/fw.php';

require '../models/Solicitudes.php';

require '../views/SolicitudesPendientes.php';

if(!isset($_SESSION['auth'])){
    header("Location: login");
    exit;
}

if($_SESSION['rol'] != 'admin'){
    header("Location: principal");
    exit;
}

$s = new Solicitudes();
$v = new SolicitudesPendientes();

$v->cantidad = $s->getCantidadSolicitudesPendientes();
$v->solicitudes = $s->getSolicitudesPendientes();
$v->render();