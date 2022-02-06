<?php

require '../fw/fw.php';
require '../fw/AuthCliente.php';

require '../views/SeleccionarFechaEvento.php';

$fecha_actual = date("d-m-Y");
$fecha_valida = date("d-m-Y", strtotime($fecha_actual."+ 3 day"));

if(isset($_POST['fecha']) && isset($_POST['turno']) && date("d-m-Y", strtotime($_POST['fecha'])) >= $fecha_valida){

    $_SESSION['fecha'] = $_POST['fecha'];
    $_SESSION['turno'] = $_POST['turno'];

    header('Location: menus-presupuesto');
    exit;
} else {

    $v = new SeleccionarFechaEvento();
    if(isset($_POST['fecha']) && date("d-m-Y", strtotime($_POST['fecha'])) < $fecha_valida){
        $v->error = true;
    } else {
        $v->error = false;
    }
    $v->render();

}

