<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Quitar Servicios</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor">
    <h1 class="center">Servicios solicitados</h1>

    <div class="contenido">
    <?php if(!$this->minimo) { ?>
    <?php foreach($this->servicios as $s) { ?>
    <p><?=$s['nombre']?></p>
    <?php } ?>
    
    <form action="" method="POST">
        <label for="servicio">Seleccione el servicio que desea eliminar: </label>
        <select name="servicio" id="servicio" class="input-style">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->servicios as $s) { ?>
            <option value="<?=$s['id_servicio']?>"><?=$s['nombre']?></option>
        <?php } ?>
        </select>
    <div>
    <input type="submit" value="Quitar" class="mt-10">
    </div>
    </form>

    <?php } else { 
        $this->mostrarMensaje("La solicitud no contiene servicios adicionales");  
    } ?>
    </div>


    <a href="solicitud-<?=$this->idSolicitud?>" class="main-btn primary">Volver</a>
    </div>
    
</body>
</html>