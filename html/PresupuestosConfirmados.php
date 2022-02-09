<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Presupuestos Confirmados</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
    <h1>Presupuestos Confirmados</h1>

    <h3> <?= $this->cantidad ?> presupuesto/s confirmados </h3>
    
    <?php foreach($this->presupuestos as $p) { ?>
        <hr/>
        <p> <span class="bold">Fecha:</span> <span class="mr-10"><?= date("d-m-Y", strtotime($p['fecha'])) ?></span> <a href="crear-evento-<?=$p['id_presupuesto']?>" class="main-btn secondary mt-0">Crear Evento</a></p> 
        <hr/>
    <?php } ?>

    <a href="principal" class="main-btn primary">Menú Principal</a>

    </div>


</body>
</html>