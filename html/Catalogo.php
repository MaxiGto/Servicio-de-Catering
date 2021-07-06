<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Catálogo</title>
</head>
<body>
    <div class="contenedor">
        <h1>Catering Essen</h1>
        <h2>Catálogo de menús y servicios disponibles</h2>

        <h3>Listado de menús</h3>

        <?php foreach($this->menus as $m) { ?>

            <h4> <?= $m['nombre'] ?> </h4>
            <p> <?= $m['descripcion'] ?> </p>
            <?php if($this->rol == 'admin') { ?>
            <span>$<?= $m['precio'] ?></span>
            <?php } ?>

        <?php } ?>

        <h3>Listado de servicios adicionales</h3>

        <?php foreach($this->servicios as $s) { ?>

            <h4> <?= $s['nombre'] ?> </h4>
            <p> <?= $s['descripcion'] ?> </p>
            <?php if($this->rol == 'admin') { ?>
            <span>$<?= $s['precio'] ?></span>
            <?php } ?>

        <?php } ?>
        
        <div>
        <a href="principal" class="main-btn primary">Menú Principal</a>
        </div>

    </div>

</body>
</html>