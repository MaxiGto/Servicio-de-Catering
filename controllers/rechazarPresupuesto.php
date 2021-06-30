<?php

require '../fw/fw.php';

require '../models/Presupuestos.php';

require '../views/PresupuestoRechazado.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

$p = new Presupuestos();

if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');

$p->presupuestoRechazado($_GET['id']);

$v = new PresupuestoRechazado();

$v->render();