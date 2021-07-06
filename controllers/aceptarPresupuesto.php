<?php

require '../fw/fw.php';
require '../fw/AuthCliente.php';

require '../models/Presupuestos.php';

require '../views/PresupuestoAceptado.php';


if(!isset($_GET['id'])) die('No existe ID de presupuesto');

$p = new Presupuestos();

if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');

$p->presupuestoAceptado($_GET['id']);

$v = new PresupuestoAceptado();

$v->render();