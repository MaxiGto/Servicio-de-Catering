<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto</title>
</head>
<body>
    <h1>Selección de servicios</h1>
    <p>Seleccione los servicios adicionales que desea para su evento</p>

    

    <form action="" method="POST">

        <select name="servicios" id="servicios">
        <?php foreach($this->servicios as $s) { ?>

        <option value="<?= $s['id_servicio'] ?>"> <?= $s['nombre'] ?> </option>

        <?php } ?>
        </select>

        <input type="submit" value="Agregar">

    </form>

        <?php if($this->agregado) $this->mostrarMensaje('Servicio agregado correctamente') ?>
        <?php if($this->repetido) $this->mostrarMensaje('No puede agregar un mismo servicio adicional más de una vez') ?>

        <a href="resumen">Ver Resumen</a>

</body>
</html>