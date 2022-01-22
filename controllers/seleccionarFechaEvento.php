<?php

require '../fw/fw.php';
require '../fw/AuthCliente.php';

require '../views/SeleccionarFechaEvento.php';

if(isset($_POST['fecha']) && isset($_POST['turno'])){

    $_SESSION['fecha'] = $_POST['fecha'];
    $_SESSION['turno'] = $_POST['turno'];

    header('Location: menus-presupuesto');
    exit;
} 

$v = new SeleccionarFechaEvento();
$v->render();