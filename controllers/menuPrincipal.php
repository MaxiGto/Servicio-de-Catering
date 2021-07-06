<?php

require '../fw/fw.php';
require '../fw/Auth.php';

require '../views/PantallaPrincipal.php';

$v = new PantallaPrincipal();

switch ($_SESSION['rol']) {
    case "admin":
        $v->rol = 'admin';
        break;
    case "cliente":
        $v->rol = 'cliente';
        break;
    default:
        header("Location: login");
        exit;
}

$v->render();