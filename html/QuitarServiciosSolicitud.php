<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quitar Servicios</title>
</head>
<body>
    <h1>Servicios solicitados</h1>

    <?php if(!$this->minimo) { ?>
    <?php foreach($this->servicios as $s) { ?>
    <p><?=$s['nombre']?></p>
    <?php } ?>

    
    <form action="" method="POST">
        <label for="servicio">Seleccione el servicio que desea eliminar: </label>
        <select name="servicio" id="servicio">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->servicios as $s) { ?>
            <option value="<?=$s['id_servicio']?>"><?=$s['nombre']?></option>
        <?php } ?>
        </select>
     <input type="submit" value="Quitar">
    </form>

    <?php } else { 
        $this->mostrarMensaje("La solicitud no contiene servicios adicionales");  
    } ?>


    <a href="solicitud-<?=$this->idSolicitud?>">Volver</a>
    
</body>
</html>