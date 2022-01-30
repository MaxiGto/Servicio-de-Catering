<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';

require '../views/ListaPresupuestosAConfirmar.php';

$p = new Presupuestos();
$v = new ListaPresupuestosAConfirmar();

$v->cantidad = $p->getCantidadPresupuestosAConfirmar();
$v->presupuestos = $p->getPresupuestosAConfirmar();
$v->render();