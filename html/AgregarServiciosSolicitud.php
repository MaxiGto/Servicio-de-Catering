<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Agregar Servicios</title>
</head>
<body>
    <div class="contenedor">
    <h1 class="center">Servicios solicitados</h1>

    <div class="contenido">
    <?php if($this->tieneServicios){
        foreach($this->servicios as $s) { ?>
        <p><?=$s['nombre']?></p>
        <?php } ?>
    <?php } else {
        $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
    <?php } ?>

    <form action="" method="POST">
        <label for="servicio" class="bold">Seleccione el servicio que desea agregar: </label>
        <select name="servicio" id="servicio" class="input-style">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->noServicios as $ns) { ?>
            <option value="<?=$ns['id_servicio']?>"><?=$ns['nombre']?></option>
        <?php } ?>
        </select>
        
        <div>
        <input type="submit" value="Agregar" class="mt-10">
        </div>
    </form>
    </div>

    <a href="solicitud-<?=$this->idSolicitud?>" class="main-btn primary">Volver</a>
    </div>

</body>
</html>