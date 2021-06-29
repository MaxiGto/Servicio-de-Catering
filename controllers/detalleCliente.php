<?php

require '../fw/fw.php';

require '../models/Clientes.php';

require '../views/DatosCliente.php';

if(!isset($_GET['id'])) die('No existe ID de cliente');

$c = new Clientes();
$v = new DatosCliente();

$v->cliente = $c->getClientByID($_GET['id']);
$v->render();





