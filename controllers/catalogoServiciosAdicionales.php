<?php

require '../fw/fw.php';
require '../fw/Auth.php';

require '../models/Servicios.php';

require '../views/CatalogoServiciosAdicionales.php';

$s = new Servicios();

$v = new CatalogoServiciosAdicionales();
if($_SESSION['rol'] == 'admin') $v->rol = 'admin';
$v->servicios = $s->getTodos();
$v->render();