<?php

require '../fw/fw.php';
require '../fw/AuthEmpleado.php';

require '../models/Solicitudes.php';
require '../models/Eventos.php';
require '../models/Empleados.php';
require '../models/Clientes.php';
require '../models/Cargos.php';
require '../models/Turnos.php';

require '../views/EventoConfirmadoEmpleado.php';

if(!isset($_GET['id'])) die('Falta ID de evento');

$ev = new Eventos();
$em = new Empleados();
$cli = new Clientes();
$c = new Cargos();
$t = new Turnos();
$v = new EventoConfirmadoEmpleado();

$ev->verificarIDEvento($_GET['id']);

$v->rol = $_SESSION['rol'];

$v->id_evento = $_GET['id'];

$evento = $ev->getEventoByID($_GET['id']);
$v->turno = $t->getTurnoByID($evento['turno']);
$v->cliente = $cli->getClientByID($evento['id_cliente']);
$v->direccion = $evento['direccion'];
$v->fecha = date("d-m-Y", strtotime($evento['fecha_evento'])); 
$v->duracion = $evento['duracion'];
$v->participantes = $ev->getCantidadMenusEvento($_GET['id'])['total'];

$legajoEncargado = $evento['legajo_encargado'];
$encargado = $em->getEmpleadoByLegajo($legajoEncargado);
$v->encargado = $encargado['apellido'] . ' ' . $encargado['nombre'];

$v->menus = $ev->getMenusEvento($_GET['id']);

$v->tieneServicios = $ev->eventoTieneServicios($_GET['id']);

if($v->tieneServicios){
    $v->servicios = $ev->getServiciosEvento($_GET['id']);
}

if($v->duracion > 6){
    $v->tieneHorasAd = true;
    $v->cantidadHoras = $v->duracion - 6;
}

$fecha_cobro = date($evento['fecha_evento']);
// echo date("d-m-Y", strtotime($fecha_actual)); 
$v->fechaACobrar = date("d-m-Y",strtotime($fecha_cobro."+ 1 day")); 

if($v->rol == 'encargado'){

    $v->mozos = $ev->getMozosEvento($_GET['id']);

    $v->aCobrar = $c->getMontoPorHoraEncargado()['monto_hora'];
}

if($v->rol == 'mozo'){

    $v->aCobrar = $c->getMontoPorHoraEncargado()['monto_hora'];
}


$v->render();