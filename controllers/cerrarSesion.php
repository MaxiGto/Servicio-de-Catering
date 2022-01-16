<?php

require '../fw/fw.php';

require '../views/Logout.php';

// unset($_SESSION['auth']);
// unset($_SESSION['id_usuario']);
// unset($_SESSION['usuario']);
// unset($_SESSION['rol']);
// unset($_SESSION['id_cliente']);
// unset($_SESSION['menus']);
// unset($_SESSION['servicios']);
// unset($_SESSION['evento']);
// unset($_SESSION['legajo']);
session_destroy();

$v = new Logout();
$v->render();






