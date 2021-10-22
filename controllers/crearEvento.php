<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Presupuestos.php';
require '../models/Eventos.php';

require '../views/CrearEvento.php';

if(!isset($_GET['id'])) die('No existe ID de presupuesto');

if(count($_POST) > 0 ){

    if(!isset($_POST['direccion'])) die('Falta dirección');
    if(!isset($_POST['fecha'])) die('Falta fecha');
    if(!isset($_POST['duracion'])) die('Falta duración');
    if(!isset($_POST['descripcion'])) die('Falta descripción');
    
    var_dump($_POST);
    $e = new Eventos();
    $e->saveNuevoEvento($_GET['id'], $_POST['direccion'], $_POST['fechaFinal'], $_POST['duracion'], $_POST['descripcion']);

} else{
    $p = new Presupuestos();
    $v = new CrearEvento();

    $v->personas = $p->getTotalMenusPresupuesto($_GET['id']);


    $v->render();
    
}