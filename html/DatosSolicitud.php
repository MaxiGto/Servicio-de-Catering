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
    <h1>Datos de la solicitud</h1>

    <p><span class="bold">Fecha de solicitud: </span><?=$this->solicitud['fecha']?></p>
    
    <h3>Menús solicitados</h3>
    <table class="center-table">
    <th>Cantidad</th><th>Nombre</th><th>Precio unitario</th><th>Total</th>
    <?php foreach($this->menus as $m) { ?>
    <tr> <td> <?=$m['cantidad']?> </td> <td> <?=$m['nombre']?> </td> <td> $<?=$m['precio']?> </td> <td> $<?=$m['total']?> </td> </tr>
    <?php } ?>
    </table>

    <p><span class="bold">Cantidad de menús: </span><?=$this->cantidadMenus['total']?></p>
    <p><span class="bold">Total menús: </span>$<?=$this->totalMenus['total_menus']?></p>
    

    <h3>Servicios adicionales solicitados</h3>
    <?php if($this->tieneServicios){ ?>
        <table class="center-table">
        <th>Nombre</th><th>Precio unitario</th><th>Total</th>
        <?php foreach($this->servicios as $s) { ?>
        <tr> <td> <?=$s['nombre']?> </td> <td> $<?=$s['precio']?> </td> <td> $<?=$s['total']?> </td> </tr>
        <?php } ?>
        </table>

        <p><span class="bold">Total servicios: </span>$<?=$this->totalServicios['total_servicios']?></p>

        <p class="highlight">Total Presupuesto: $<?= $this->totalMenus['total_menus'] + $this->totalServicios['total_servicios'] ?></p>
    <?php } else {
        $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
        <p class="highlight">Total Presupuesto: $<?= $this->totalMenus['total_menus'] ?></p>
    <?php } ?>
        

    <p><span class="bold">Comentario: </span><?=$this->solicitud['comentario']?></p>

    <div>
    <a href="agregar-menus-<?=$this->solicitud['id_solicitud']?>" class="main-btn secondary">Agregar Menus</a>
    <a href="quitar-menus-<?=$this->solicitud['id_solicitud']?>" class="main-btn tertiary">Quitar Menus</a>
    </div>

    <div>
        <a href="agregar-servicios-<?=$this->solicitud['id_solicitud']?>" class="main-btn secondary">Agregar Servicios</a>
        <a href="quitar-servicios-<?=$this->solicitud['id_solicitud']?>" class="main-btn tertiary">Quitar Servicios</a>
    </div>
    <div>
        <a href="confirmar-presupuesto-<?=$this->solicitud['id_solicitud']?>" class="main-btn primary">Confirmar y enviar presupuesto</a>
    </div>
    <div>
        <a href="principal" class="main-btn primary">Menu Principal</a>
    </div>
    </div>
</body>
</html>