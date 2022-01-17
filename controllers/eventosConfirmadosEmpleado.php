<?php

require '../fw/fw.php';
require '../fw/AuthEmpleado.php';

require '../models/Eventos.php';

require '../views/EventosConfirmadosEmpleado.php';

$v = new EventosConfirmadosEmpleado();
$e = new Eventos();

switch ($_SESSION['rol']) {
    case "encargado":
        $v->rol = 'encargado';
        $v->cantidad = $e->getCantidadEventosConfirmadosEncargado($_SESSION['legajo']);
        $v->eventos = $e->getEventosConfirmadosEncargado($_SESSION['legajo']);

        $v->render();
        break;
    case "mozo":
        $v->rol = 'mozo';
        $v->cantidad = $e->getCantidadEventosConfirmadosMozo($_SESSION['legajo']);
        $v->eventos = $e->getEventosConfirmadosMozo($_SESSION['legajo']);

        $v->render();
        break;
    default:
        header("Location: login");
        exit;
}
