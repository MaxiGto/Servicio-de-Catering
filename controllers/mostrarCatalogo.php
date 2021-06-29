<?php

require '../fw/fw.php';

require '../models/Menus.php';
require '../models/Servicios.php';

require '../views/Catalogo.php';

if(!isset( $_SESSION['auth'])){
    header('Location: login');
    exit;
}

$m = new Menus();
$s = new Servicios();

$v = new Catalogo();
$v->menus = $m->getTodos();
$v->servicios = $s->getTodos();
$v->render();