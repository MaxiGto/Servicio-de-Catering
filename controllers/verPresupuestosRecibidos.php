<?php

require '../fw/fw.php';
require '../fw/AuthCliente.php';

require '../models/Clientes.php';
require '../models/Presupuestos.php';

require '../views/PresupuestosRecibidos.php';

if(!isset($_SESSION['id_cliente'])) die('No existe ID de cliente');

$c = new Clientes();
$p = new Presupuestos();
$v = new PresupuestosRecibidos();

if(!$c->verificarIDCliente($_SESSION['id_cliente'])) die('ID de cliente inválido');

$v->cantidad = $p->getCantidadPresupuestosCliente($_SESSION['id_cliente']);
$v->presupuestos = $p->getPresupuestosCliente($_SESSION['id_cliente']);
$v->render();