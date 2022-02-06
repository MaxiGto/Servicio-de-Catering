<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';
require '../models/Empleados.php';
require '../models/Clientes.php';
require '../models/Turnos.php';

require '../views/ResumenEvento.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

if(count($_POST) > 0){

    $e = new Empleados();
    $p = new Presupuestos();
    $t = new Turnos();
    $c = new Clientes();
    $v = new ResumenEvento();

    if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');
    if(!$p->verificarPresupuestoAceptado($_GET['id'])) die('ID de presupuesto incorrecto');

    $v->id_presupuesto = $_GET['id'];

    $encargado = $e->getEmpleadoByLegajo($_SESSION['evento']['encargado']);
    $pys = $p->getSolicitudPresupuesto($_GET['id']);
    $v->cliente = $c->getClientByID($pys['id_cliente']);

    $v->encargado = $encargado['apellido'] . ' ' . $encargado['nombre'];
    $v->direccion = $pys['direccion'];
    $v->fecha = $pys['fecha_evento'];
    $v->turno = $t->getTurnoByID($pys['turno']);
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

    if($pys['horasAd'] > 0){
        $v->tieneHorasAd = true;
        $v->cantidadHoras = $pys['horasAd'];
        $v->precioHora = $pys['precio_horasAd'];
    }

    $v->observaciones = $pys['observaciones'];
    $v->mozos = $_POST;
    $_SESSION['evento']['mozos'] = $_POST;
    $_SESSION['evento']['horasAd'] = $v->cantidadHoras;
    $v->render();

} else {
    header("Location: presupuestos-aceptados");
    exit;
}