<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';
require '../models/Eventos.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

if(isset($_SESSION['evento'])){

    $p = new Presupuestos();
    $e = new Eventos();

    if(!$p->verificarIDPresupuesto($_GET['id'])) die('ID de presupuesto inválido');
    if(!$p->verificarPresupuestoAceptado($_GET['id'])) die('ID de presupuesto incorrecto');

    $id_evento = $e->saveNuevoEvento($_GET['id'], 
                        $_SESSION['evento']['direccion'], 
                        $_SESSION['evento']['fechaFinal'], 
                        $_SESSION['evento']['duracion'], 
                        $_SESSION['evento']['encargado'],
                        $_SESSION['evento']['descripcion']
    );

    $e->asignarMozosEvento($id_evento, $_SESSION['evento']['mozos']);

    echo'<script type="text/javascript">
        alert("Evento creado satisfactoriamente");
        </script>';

    header("Location: presupuestos-aceptados");
    exit;

} else {
    header("Location: presupuestos-aceptados");
    exit;
}

