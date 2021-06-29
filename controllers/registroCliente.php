<?php

require '../fw/fw.php';

require '../models/Clientes.php';
require '../models/Usuarios.php';

require '../views/RegistroCliente.php';



if(count($_POST)>0){

    if(!isset($_POST['nombre'])) die('Falta nombre');
    if(!isset($_POST['apellido'])) die('Falta apellido');
    if(!isset($_POST['email'])) die('Falta email');
    if(!isset($_POST['telefono'])) die('Falta teléfono');

    if(!isset($_POST['usuario'])) die('Falta nombre de usuario');
    if(!isset($_POST['password'])) die('Falta contraseña');
    if(!isset($_POST['password2'])) die('Falta confirmar contraseña');

    $c = new Clientes();
    $u = new Usuarios();


    $u->nuevoUsuario($_POST['usuario'], $_POST['password'], $_POST['password2']);
    $c->nuevoCliente($_POST['usuario'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['telefono']);



    
    

} else {
    $v = new RegistroCliente();
    $v->render();
}
