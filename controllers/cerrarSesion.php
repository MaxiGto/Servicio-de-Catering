<?php

require '../fw/fw.php';

require '../views/Logout.php';

unset($_SESSION['auth']);
unset($_SESSION['id_usuario']);
unset($_SESSION['usuario']);
unset($_SESSION['rol']);
unset($_SESSION['id_cliente']);
unset($_SESSION['menus']);
unset($_SESSION['servicios']);

$v = new Logout();
$v->render();






