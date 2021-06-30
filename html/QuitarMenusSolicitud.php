<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quitar menús</title>
</head>
<body>
    <h1>Menús solicitados</h1>

    <?php foreach($this->menus as $m) { ?>
    <p><?=$m['cantidad']?> <?=$m['nombre']?></p>
    <?php } ?>

    <?php if(!$this->minimo) { ?>
    <form action="" method="POST">
        <label for="menu">Seleccione el menú que desea eliminar: </label>
        <select name="menu" id="menu">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->menus as $m) { ?>
            <option value="<?=$m['id_menu']?>"><?=$m['nombre']?></option>
        <?php } ?>
        </select>
     <input type="submit" value="Quitar">
    </form>

    <?php } else { 
        $this->mostrarMensaje("La solicitud debe contener al menos 1 tipo de menú");  
    } ?>


    <a href="solicitud-<?=$this->idSolicitud?>">Volver</a>
    
</body>
</html>