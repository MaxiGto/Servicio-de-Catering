<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';
require '../models/Empleados.php';

require '../views/SeleccionarEncargado.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

if(isset($_POST['direccion'])){
    $p = new Presupuestos();
    $e = new Empleados();
    $v = new SeleccionarEncargado();

    if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');
    // if(!$p->verificarPresupuestoPendiente($_GET['id'])) die('Presupuesto no disponible');
    if(!$p->verificarPresupuestoAceptado($_GET['id'])) die('ID de presupuesto incorrecto');
    $v->encargados = $e->getEncargados();
    $v->id_presupuesto =  $_SESSION['evento']['id_presupuesto'];

    $_SESSION['evento']['direccion'] = $_POST['direccion'];
    $_SESSION['evento']['duracion'] = $_POST['duracion'];
    $_SESSION['evento']['descripcion'] = $_POST['descripcion'];
    $_SESSION['evento']['fechaFinal'] = $_POST['fechaFinal'];

    var_dump($_SESSION['evento']);

    $v->render();
    } else {
    header("Location: presupuestos-aceptados");
    exit;
}

