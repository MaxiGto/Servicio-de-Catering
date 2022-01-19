<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';
require '../models/Empleados.php';

require '../views/ResumenEvento.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

if(count($_POST) > 0){

    $e = new Empleados();
    $p = new Presupuestos();
    $v = new ResumenEvento();

    if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');
    if(!$p->verificarPresupuestoAceptado($_GET['id'])) die('ID de presupuesto incorrecto');

    $v->id_presupuesto = $_GET['id'];

    $encargado = $e->getEmpleadoByLegajo($_SESSION['evento']['encargado']);

    $v->encargado = $encargado['apellido'] . ' ' . $encargado['nombre'];
    $v->direccion = $_SESSION['evento']['direccion'];
    $v->fechaHora = substr($_SESSION['evento']['fechaFinal'], 0, 16);
    $v->duracion = $_SESSION['evento']['duracion'];
    $v->participantes = $p->getTotalMenusPresupuesto($_GET['id'])['total'];
    $v->menus = $p->getMenusPresupuesto($_GET['id']);

    $v->totalMenus = $p->getPrecioTotalMenusPresupuesto($_GET['id'])['total_menus'];

    if($p->presupuestoTieneServicios($_GET['id'])){
        $v->tieneServicios = true;
        $v->servicios = $p->getServiciosPresupuesto($_GET['id']);
        $v->totalServicios = $p->getPrecioTotalServiciosPresupuesto($_GET['id'])['total_servicios'];
    } else{
        $v->tieneServicios = false;
    }

    $v->mozos = $_POST;
    $_SESSION['evento']['mozos'] = $_POST;

    var_dump($_SESSION['evento']);

    $v->render();

} else {
    header("Location: presupuestos-aceptados");
    exit;
}