<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud</title>
</head>
<body>
    <h1>Datos de la solicitud</h1>
    <p>Fecha de solicitud: <?=$this->solicitud['fecha']?></p>
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
        

    <p>Comentario: <?=$this->solicitud['comentario']?></p>

    <div>
    <a href="agregar-menus-<?=$this->solicitud['id_solicitud']?>">Agregar Menus</a>
    <a href="quitar-menus-<?=$this->solicitud['id_solicitud']?>">Quitar Menus</a>
    </div>

    <div>
    <a href="agregar-servicios-<?=$this->solicitud['id_solicitud']?>">Agregar Servicios</a>
    <a href="quitar-servicios-<?=$this->solicitud['id_solicitud']?>">Quitar Servicios</a>
    </div>
    <a href="confirmar-presupuesto-<?=$this->solicitud['id_solicitud']?>">Confirmar y enviar presupuesto</a>
</body>
</html>