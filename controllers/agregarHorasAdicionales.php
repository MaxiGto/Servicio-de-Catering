<?php

require '../fw/fw.php';
require '../fw/AuthAdmin.php';

require '../models/Solicitudes.php';

require '../views/AgregarHorasAdicionales.php';

if(!isset($_GET['id'])) die('No existe ID de solicitud');

$s = new Solicitudes();
$v = new AgregarHorasAdicionales();

if(!$s->verificarIDSolicitud($_GET['id'])) die('ID de solicitud inválido');
$v->idSolicitud = $_GET['id'];

if(count($_POST) > 0 && $_POST['horas'] > 0 && $_POST['precio'] >= 0){
    
    echo'<script type="text/javascript">
        alert("Horas adicionales agregadas satisfactoriamente");
        </script>';

    $_SESSION['horasAdicionales'] = $_POST['horas'];
    $_SESSION['precioHorasAd'] = $_POST['precio'];

    header("Location: solicitud-$v->idSolicitud");
    exit;

} else {
    if(isset($_POST['horas']) && $_POST['horas'] <= 0) $v->error = true;
    if(isset($_POST['horas']) && $_POST['precio'] < 0) $v->error = true;
    $v->render();
}
