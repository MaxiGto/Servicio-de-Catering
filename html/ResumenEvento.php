<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Resumen del evento</title>
</head>
<body>
    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
        <h1>Datos del evento a crear</h1>

        <div class="contenido">

        <h3>Información general</h3>
        
        <p>
        <span class="bold">Encargado/a:</span> <?=$this->encargado?> -
        <span class="bold">Dirección:</span> <?=$this->direccion?> -
        <span class="bold">Fecha:</span> <?=$this->fecha?> -
        <span class="bold">Turno:</span> <?=$this->turno['nombre']?> (<?=$this->turno['horario']?>) -
        <span class="bold">Participantes:</span> <?=$this->participantes?> personas
        </p>

        <h3>Menús solicitados</h3>

        <table class="center-table">
        <th>Cantidad</th><th>Nombre</th><th>Precio unitario</th><th>Total</th>
        <?php foreach($this->menus as $m) { ?>
        <tr><td><?=$m['cantidad']?></td> <td><?=$m['nombre']?></td> <td>$<?=$m['precio']?></td> <td>$<?=$m['total']?></td></tr>
        <?php } ?>
        </table>

        <h3>Servicios adicionales solicitados</h3>

        <?php if($this->tieneServicios){ ?>
            <table class="center-table">
            <th>Nombre</th><th>Precio unitario</th><th>Total</th>
            <?php foreach($this->servicios as $s) { ?>
            <tr><td><?=$s['nombre']?></td><td>$<?=$s['precio']?></td><td>$<?=$s['total']?></td></tr>
            <?php } ?>
            </table>
            <p><span class="bold">Total servicios:</span> $<?=$this->totalServicios?> (<?=$this->participantes?> personas)</p>

        <?php } else {
            $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
        <?php } ?>

        <?php if($this->tieneHorasAd){ ?>
            <table class="center-table">
            <th>Cantidad</th><th>Nombre</th><th>Precio unitario</th><th>Total</th>
            <tr><td><?=$this->cantidadHoras?></td><td>Horas adicionales</td><td>$<?=$this->precioHora?></td><td>$<?=$this->cantidadHoras * $this->precioHora?></td></tr>
            </table>
        <?php } ?>

        <h3>Lista de mozos seleccionados</h3>
    
        <?php foreach($this->mozos as $mo) { ?>
        <ul>
            <li><?=$mo?></li>
        </ul>
        <?php } ?>

        <?php if($this->observaciones == "") { ?>
            <p><span class="bold">Observaciones: </span>No hay observaciones </p>
        <?php } else { ?>
            <p><span class="bold">Observaciones: </span><?=$this->observaciones?></p>
        <?php } ?>

        <div>
            <a href="presupuestos-aceptados" class="main-btn secondary">Volver</a>
            <a href="confirmar-evento-<?=$this->id_presupuesto?>" class="main-btn primary">Confirmar Evento</a>
        </div>

        </div>

        
        

    </div>
    

    

</body>
</html>