<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Presupuesto</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor">
    <h1>Selección de servicios</h1>
    <div class="contenido">
    <h3>Seleccione los servicios adicionales que desea para su evento</h3>

    <form action="" method="POST">

        <select name="servicios" id="servicios" class="input-style">
        <?php foreach($this->servicios as $s) { ?>

        <option value="<?= $s['id_servicio'] ?>"> <?= $s['nombre'] ?> </option>

        <?php } ?>
        </select>

        <input type="submit" value="Agregar">

    </form>

        <?php if($this->agregado) $this->mostrarMensaje('Servicio agregado correctamente') ?>
        <?php if($this->repetido) $this->mostrarMensaje('No puede agregar un mismo servicio adicional más de una vez') ?>

        <div>
        <a href="menus-presupuesto" class="main-btn secondary">Volver</a>
        <a href="resumen" class="main-btn primary">Ver Resumen</a>
        </div>
    </div>
    </div>

</body>
</html>