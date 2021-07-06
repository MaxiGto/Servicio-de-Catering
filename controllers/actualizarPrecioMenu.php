<?php

require '../fw/fw.php';

require '../models/Menus.php';

require '../views/ModificarPrecioMenu.php';

require '../fw/AuthAdmin.php';

$m = new Menus();
$v = new ModificarPrecioMenu();

if(isset($_GET['menu'])){

    if(!$m->verificarMenu($_GET['menu'])) die('ID de menú inválido');
    $v->selected = true;
    $v->selectedMenu = $m->getMenuByID($_GET['menu']);
    

    if(isset($_POST['precio'])){
        $m->setPrecioMenu($_GET['menu'], $_POST['precio']);
        $v->actualizado = true;
    }

    $v->selectedMenu = $m->getMenuByID($_GET['menu']);
    $v->menus = $m->getTodos();
    $v->render();

} else {
    
    $v->menus = $m->getTodos();
    $v->render();
}

