<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Solicitudes.php';

require '../views/SolicitudesPendientes.php';

$s = new Solicitudes();
$v = new SolicitudesPendientes();

$v->cantidad = $s->getCantidadSolicitudesPendientes();
$v->solicitudes = $s->getSolicitudesPendientes();
$v->render();