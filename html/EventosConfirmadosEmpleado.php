<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Listado de eventos confirmados</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
    <h1>Eventos confirmados</h1>

    <h3> <?= $this->cantidad ?> evento/s confirmados </h3>
    
    <?php foreach($this->eventos as $e) { ?>
        
        <hr/>
        <p> <span class="bold">Fecha y hora:</span> <span class="mr-10"><?= substr($e['fecha'], 0, 16) ?></span> <a href="evento-confirmado-empleado-<?=$e['id_evento']?>" class="main-btn secondary mt-0">Ver Detalle</a>
        <hr/>
    <?php } ?>

    <a href="principal" class="main-btn primary">Menú Principal</a>

    </div>


</body>
</html>