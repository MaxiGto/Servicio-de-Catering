<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Agregar Menús</title>
</head>
<body>
    <div class="contenedor">
    <h1 class="center">Menús solicitados</h1>

    <div class="contenido">
    <?php foreach($this->menus as $m) { ?>
    <p><?=$m['cantidad']?> <?=$m['nombre']?></p>
    <?php } ?>

    <form action="" method="POST">
        <label for="menu" class="bold">Seleccione el menú que desea agregar: </label>
        <select name="menu" id="menu" class="input-style">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->noMenus as $nm) { ?>
            <option value="<?=$nm['id_menu']?>"><?=$nm['nombre']?></option>
        <?php } ?>
        </select>
        
        <div class="mt-10">
        <label for="cantidad" class="bold">Cantidad: </label>
        <input type="number" name="cantidad" min="1" value="1" class="input-style">
        </div>
        <div class="mt-10">
        <input type="submit" value="Agregar">
        </div>
    </form>
    </div>

    <a href="solicitud-<?=$this->idSolicitud?>" class="main-btn primary">Volver</a>
    </div>

</body>
</html>