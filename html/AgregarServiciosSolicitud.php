<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Servicios</title>
</head>
<body>
    <h1>Servicios solicitados</h1>

    <h3>Servicios solicitados</h3>
    <?php if($this->tieneServicios){
        foreach($this->servicios as $s) { ?>
        <p><?=$s['nombre']?></p>
        <?php } ?>
    <?php } else {
        $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
    <?php } ?>

    <form action="" method="POST">
        <label for="servicio">Seleccione el servicio que desea agregar: </label>
        <select name="servicio" id="servicio">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->noServicios as $ns) { ?>
            <option value="<?=$ns['id_servicio']?>"><?=$ns['nombre']?></option>
        <?php } ?>
        </select>

        <input type="submit" value="Agregar">
    </form>

    <a href="solicitud-<?=$this->idSolicitud?>">Volver</a>

</body>
</html>