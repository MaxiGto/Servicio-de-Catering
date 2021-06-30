<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud</title>
</head>
<body>
    <h1>Datos del presupuesto</h1>
    <p>Fecha de presupuesto: <?=$this->presupuesto['fecha']?></p>
    <h3>Menús solicitados</h3>
    <?php foreach($this->menus as $m) { ?>
    <p><?=$m['cantidad']?> <?=$m['nombre']?> $<?=$m['precio']?> $<?=$m['total']?></p>
    <?php } ?>
    <p>Cantidad de menús: <?=$this->cantidadMenus['total']?></p>
    <p>Total menús: $<?=$this->totalMenus['total_menus']?></p>

    <h3>Servicios adicionales solicitados</h3>
    <?php if($this->tieneServicios){
        foreach($this->servicios as $s) { ?>
        <p><?=$s['nombre']?> $<?=$s['precio']?> $<?=$s['total']?></p>
        <?php } ?>
        <p>Total servicios: $<?=$this->totalServicios['total_servicios']?></p>
        <p>Total Presupuesto: $<?= $this->totalMenus['total_menus'] + $this->totalServicios['total_servicios'] ?></p>
    <?php } else {
        $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
        <p>Total Presupuesto: $<?= $this->totalMenus['total_menus'] ?></p>
    <?php } ?>

    <a href="aceptar-presupuesto-<?=$this->presupuesto['id_presupuesto']?>">Aceptar presupuesto</a>
    <a href="rechazar-presupuesto-<?=$this->presupuesto['id_presupuesto']?>">Rechazar presupuesto</a>
</body>
</html>