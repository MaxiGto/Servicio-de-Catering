<?php

require '../fw/fw.php';

require '../models/Usuarios.php';
require '../models/Clientes.php';

require '../views/Login.php';

if(count($_POST) > 0){

    if(!isset($_POST['user'])) die('Falta email');
    if(!isset($_POST['password'])) die('Falta contraseña');

    $u = new Usuarios();

    if($u->autenticarUsuario($_POST['user'], $_POST['password'])){
        session_start();
        $_SESSION['auth'] = true;
        $usuario = $u->getUsuarioPorNombre($_POST['user']);
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['usuario'] = $usuario['usuario'];
        $_SESSION['rol'] = $usuario['rol'];

        $c = new Clientes();
        $cliente = $c->getClientByUserName($_SESSION['usuario']);
        $_SESSION['id_cliente'] = $cliente['id_cliente'];

        header('Location: catalogo');
        exit;
    } else {
        $v = new Login();
        $v->error = true;
        $v->render();
    }

} 

$v = new Login();
$v->render();


