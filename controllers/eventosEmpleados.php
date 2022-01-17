<?php

require '../fw/fw.php';
require '../fw/AuthEmpleado.php';

require '../models/Eventos.php';

require '../views/EventosEmpleados.php';

$v = new EventosEmpleados();
$e = new Eventos();

switch ($_SESSION['rol']) {
    case "encargado":
        $v->rol = 'encargado';
        $v->cantidad = $e->getCantidadEventosAConfirmarEncargado($_SESSION['legajo']);
        $v->eventos = $e->getEventosEncargado($_SESSION['legajo']);

        $v->render();
        break;
    case "mozo":
        $v->rol = 'mozo';
        $v->cantidad = $e->getCantidadEventosMozo($_SESSION['legajo']);
        $v->eventos = $e->getEventosMozo($_SESSION['legajo']);

        $v->render();
        break;
    default:
        header("Location: login");
        exit;
}

