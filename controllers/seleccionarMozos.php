<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';
require '../models/Empleados.php';

require '../views/SeleccionarMozos.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

if(isset($_POST['encargado'])){
    $p = new Presupuestos();
    $e = new Empleados();
    $v = new SeleccionarMozos();

    if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');
    // if(!$p->verificarPresupuestoPendiente($_GET['id'])) die('Presupuesto no disponible');
    if(!$p->verificarPresupuestoAceptado($_GET['id'])) die('ID de presupuesto incorrecto');
    $v->mozos = $e->getMozos();
    $v->id_presupuesto =  $_SESSION['evento']['id_presupuesto'];

    $_SESSION['evento']['encargado'] = $_POST['encargado'];

    var_dump($_SESSION['evento']);
    var_dump($_POST['encargado']);

    $v->render();
    } else {
    header("Location: presupuestos-aceptados");
    exit;
}