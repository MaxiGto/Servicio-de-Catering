<?php

require '../fw/fw.php';
require '../fw/AuthEmpleado.php';

require '../models/Eventos.php';

if(!isset($_GET['id'])) die('Falta ID de evento');

$ev = new Eventos();

if(!$ev->verificarIDEvento($_GET['id'])) die('ID de evento inválido');

if($_SESSION['rol'] == 'encargado'){
    $ev->confirmarEventoEncargado($_GET['id']);
}

if($_SESSION['rol'] == 'mozo'){
    $ev->confirmarEventoMozo($_GET['id'], $_SESSION['legajo']);
}

echo'<script type="text/javascript">
        alert("Evento confirmado satisfactoriamente");
        </script>';

header("Location: eventos-empleados");
exit;