<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Modificar precio</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
    <h1>Actualización de precios de menús</h1>

    <div class="contenido">
    <form action="" method="GET">
        <label for="menu">Seleccione el menú cuyo precio desea modificar: </label>
        <select name="menu" id="menu" class="input-style">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->menus as $m) { ?>
            <option value="<?=$m['id_menu']?>"><?=$m['nombre']?></option>
        <?php } ?>
        </select>

        <div>
        <input type="submit" value="Actualizar Precio" class="mt-10">
        </div>
    </form>

    <?php if($this->selected){ ?>
        <h3><?=$this->selectedMenu['nombre']?></h3>
        <p><?=$this->selectedMenu['descripcion']?></p>
        <span>$<?=$this->selectedMenu['precio']?></span>
        <form action="" method="POST">
            <label for="precio">Nuevo Precio:</label>
            <input type="number" name="precio" id="precio" min="0" value="0" class="input-style">
            <input type="submit" value="Actualizar">
        </form>
    <?php } ?>

    <?php if($this->actualizado) $this->mostrarMensaje('Precio actualizado correctamente') ?>
    </div>

    <a href="principal" class="main-btn primary">Menú Principal</a>
    </div>


</body>
</html>