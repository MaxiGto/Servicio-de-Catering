<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
</head>
<body>
    <h1>Catering Essen</h1>
    <h2>Catálogo de menús y servicios disponibles</h2>

    <h3>Listado de menús</h3>

    <?php foreach($this->menus as $m) { ?>

        <h4> <?= $m['nombre'] ?> </h4>
        <p> <?= $m['descripcion'] ?> </p>

    <?php } ?>

    <h3>Listado de servicios adicionales</h3>

    <?php foreach($this->servicios as $s) { ?>

        <h4> <?= $s['nombre'] ?> </h4>
        <p> <?= $s['descripcion'] ?> </p>

    <?php } ?>

</body>
</html>