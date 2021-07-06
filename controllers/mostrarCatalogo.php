<?php

require '../fw/fw.php';
require '../fw/Auth.php';

require '../models/Menus.php';
require '../models/Servicios.php';

require '../views/Catalogo.php';

$m = new Menus();
$s = new Servicios();

$v = new Catalogo();
if($_SESSION['rol'] == 'admin') $v->rol = 'admin';
$v->menus = $m->getTodos();
$v->servicios = $s->getTodos();
$v->render();