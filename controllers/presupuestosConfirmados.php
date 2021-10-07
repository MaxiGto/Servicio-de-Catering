<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';

require '../views/PresupuestosConfirmados.php';

$p = new Presupuestos();
$v = new PresupuestosConfirmados();

$v->presupuestos = $p->getPresupuestosAceptados();
$v->cantidad = $p->getCantidadPresupuestosAceptados();
$v->render();
