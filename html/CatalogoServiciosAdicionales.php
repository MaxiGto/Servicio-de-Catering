<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Catálogo</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor">
        <h1>Catering Essen</h1>
        <h2>Catálogo de servicios adicionales disponibles</h2>

        <a href="catalogo" class="main-btn secondary">Ver menús</a>

        <h3>Listado de servicios adicionales</h3>

        <?php foreach($this->servicios as $s) { ?>

            <h4> <?= $s['nombre'] ?> </h4>
            <p> <?= $s['descripcion'] ?> </p>
            <span>$<?= $s['precio'] ?></span>

        <?php } ?>
        
        <div>
        <a href="principal" class="main-btn primary">Menú Principal</a>
        </div>

    </div>

</body>
</html>