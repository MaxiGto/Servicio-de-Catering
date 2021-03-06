<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Listado de eventos a confirmar</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
    <h1>Eventos a confirmar</h1>

    <h3> <?= $this->cantidad ?> evento/s a confirmar </h3>
    
    <?php foreach($this->eventos as $e) { ?>
        
        <hr/>
        <p> <span class="bold">Fecha: </span> <span class="mr-10"><?=date("d-m-Y", strtotime($e['fecha_evento']))?></span> <a href="evento-empleado-<?=$e['id_evento']?>" class="main-btn secondary mt-0">Ver Detalle</a>
        <hr/>
    <?php } ?>

    <a href="principal" class="main-btn primary">Menú Principal</a>

    </div>


</body>
</html>