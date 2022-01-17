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

        <a href="catalogo-servicios-adicionales" class="main-btn secondary">Ver servicios adicionales</a>

        <h3>Catálogo de menús disponibles</h3>

        <?php foreach($this->menus as $m) { ?>

            <h4> <?= $m['nombre'] ?> </h4>
            <p> <?= $m['descripcion'] ?> </p>
            <span>$<?= $m['precio'] ?></span>

        <?php } ?>
        
        <div>
        <a href="principal" class="main-btn primary">Menú Principal</a>
        </div>

    </div>

</body>
</html>