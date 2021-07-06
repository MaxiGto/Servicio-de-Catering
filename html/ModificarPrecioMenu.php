<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar precio</title>
</head>
<body>
    <h1>Actualización de precios de menús</h1>

    <form action="" method="GET">
        <label for="menu">Seleccione el menú cuyo precio desea modificar: </label>
        <select name="menu" id="menu">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->menus as $m) { ?>
            <option value="<?=$m['id_menu']?>"><?=$m['nombre']?></option>
        <?php } ?>
        </select>

        <input type="submit" value="Actualizar Precio">
    </form>

    <?php if($this->selected){ ?>
        <h3><?=$this->selectedMenu['nombre']?></h3>
        <p><?=$this->selectedMenu['descripcion']?></p>
        <span>$<?=$this->selectedMenu['precio']?></span>
        <form action="" method="POST">
            <label for="precio">Nuevo Precio:</label>
            <input type="number" name="precio" id="precio" min="0" value="0">
            <input type="submit" value="Actualizar">
        </form>
    <?php } ?>

    <?php if($this->actualizado) $this->mostrarMensaje('Precio actualizado correctamente') ?>


</body>
</html>