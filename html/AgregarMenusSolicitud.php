<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Menús</title>
</head>
<body>
    <h1>Menús solicitados</h1>

    <h3>Menús solicitados</h3>
    <?php foreach($this->menus as $m) { ?>
    <p><?=$m['cantidad']?> <?=$m['nombre']?></p>
    <?php } ?>

    <form action="" method="POST">
        <label for="menu">Seleccione el menú que desea agregar: </label>
        <select name="menu" id="menu">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->noMenus as $nm) { ?>
            <option value="<?=$nm['id_menu']?>"><?=$nm['nombre']?></option>
        <?php } ?>
        </select>

        <label for="cantidad">Cantidad: </label>
        <input type="number" name="cantidad" min="1" value="1">

        <input type="submit" value="Agregar">
    </form>

    <a href="solicitud-<?=$this->idSolicitud?>">Volver</a>

</body>
</html>