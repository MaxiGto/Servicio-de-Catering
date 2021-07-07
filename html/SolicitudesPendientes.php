<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Solicitudes</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
        <h1>Solicitudes Pendientes</h1>

        <h3> <?= $this->cantidad ?> solicitudes pendientes </h3>

        <table>
        
        <?php foreach($this->solicitudes as $s) { ?>
            <hr/>
            <p> <span class="bold">Fecha: </span> <span class="mr-10"><?= $s['fecha'] ?></span> <a href="solicitud-<?=$s['id_solicitud']?>" class="main-btn primary mt-0">Ver solicitud</a> <a href="cliente-<?=$s['id_cliente']?>" class="main-btn secondary mt-0">Ver cliente</a></p>
            <hr/>
        <?php } ?>

        </table>

        <a href="principal" class="main-btn primary">Menú Principal</a>
    </div>


</body>
</html>