<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Solicitud</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
        <h1>Datos del presupuesto</h1>

        <p><span class="bold">Fecha de presupuesto: </span> <?=$this->presupuesto['fecha']?></p>

        <h3>Menús solicitados</h3>

        <table class="center-table">
        <th>Cantidad</th><th>Nombre</th><th>Precio unitario</th><th>Total</th>
        <?php foreach($this->menus as $m) { ?>
        <tr><td><?=$m['cantidad']?></td> <td><?=$m['nombre']?></td> <td>$<?=$m['precio']?></td> <td>$<?=$m['total']?></td></tr>
        <?php } ?>
        </table>

        <p><span class="bold">Cantidad de menús:</span> <?=$this->cantidadMenus['total']?> (1 x persona)</p>
        <p><span class="bold">Total menús:</span> $<?=$this->totalMenus['total_menus']?></p>

        <h3>Servicios adicionales solicitados</h3>

        <?php if($this->tieneServicios){ ?>
            <table class="center-table">
            <th>Nombre</th><th>Precio unitario</th><th>Total</th>
            <?php foreach($this->servicios as $s) { ?>
            <tr><td><?=$s['nombre']?></td><td>$<?=$s['precio']?></td><td>$<?=$s['total']?></td></tr>
            <?php } ?>
            </table>
            <p><span class="bold">Total servicios:</span> $<?=$this->totalServicios['total_servicios']?> (<?=$this->cantidadMenus['total']?> personas)</p>

            <p class="highlight">Total Presupuesto: <span class="bold">$<?= $this->totalMenus['total_menus'] + $this->totalServicios['total_servicios'] ?></span></p>
        <?php } else {
            $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
            <p class="highlight">Total Presupuesto: <span class="bold">$<?= $this->totalMenus['total_menus'] ?></span></p>
        <?php } ?>

        <a href="aceptar-presupuesto-<?=$this->presupuesto['id_presupuesto']?>" class="main-btn secondary">Aceptar presupuesto</a>
        <a href="rechazar-presupuesto-<?=$this->presupuesto['id_presupuesto']?>" class="main-btn tertiary">Rechazar presupuesto</a>
        <div>
            <a href="presupuestos-recibidos" class="main-btn primary">Volver</a>
        </div>
    </div>
</body>
</html>