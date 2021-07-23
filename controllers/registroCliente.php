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

    $usuario = htmlentities($_POST['usuario']);
    $nombre = htmlentities($_POST['nombre']);
    $apellido = htmlentities($_POST['apellido']);
    $email = htmlentities($_POST['email']);
    $telefono = htmlentities($_POST['telefono']);

    $c = new Clientes();
    $u = new Usuarios();

    try {
        $u->nuevoUsuario($usuario, $_POST['password'], $_POST['password2']);
        $c->nuevoCliente($usuario, $nombre, $apellido, $email, $telefono);

        header("Location: registro-completado");
        exit;

    } catch (ValidationException $e) {
        $lastID = $u->ultimoUsuarioInsertado();
        $u->borrarUsuarioByID($lastID);
        $v = new RegistroCliente();
        $v->error = true;
        $v->render();
    }
    

} else {
    $v = new RegistroCliente();
    $v->render();
}
