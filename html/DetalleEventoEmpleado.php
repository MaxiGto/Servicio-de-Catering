<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Detalle del evento</title>
</head>
<body>
    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
        <h1>Datos del evento</h1>

        <div class="contenido">

        <h3>Información general</h3>
        
        <p>
            <span class="bold">Encargado/a:</span> <?=$this->encargado?> -
            <span class="bold">Dirección:</span> <?=$this->direccion?> -
            <span class="bold">Fecha:</span> <?=$this->fecha?> -
            <span class="bold">Turno:</span> <?=$this->turno['nombre']?> -
            <span class="bold">Duración:</span> <?=$this->duracion?> hs -
            <span class="bold">Participantes:</span> <?=$this->participantes?> personas
        </p>

        <h3>Datos del cliente</h3>
            <p>
                <span class="bold">Nombre: </span><?=$this->cliente['nombre'] . " " . $this->cliente['apellido']?> - 
                <span class="bold">Usuario: </span><?=$this->cliente['usuario']?> -
                <span class="bold">Email: </span><?=$this->cliente['email']?> - 
                <span class="bold">Teléfono: </span><?=$this->cliente['telefono']?>
            </p>

        <h3>Menús solicitados</h3>

        <table class="center-table">
        <th>Cantidad</th><th>Nombre</th>
        <?php foreach($this->menus as $m) { ?>
        <tr><td><?=$m['cantidad']?></td> <td><?=$m['nombre']?></td></tr>
        <?php } ?>
        </table>

        <h3>Servicios adicionales solicitados</h3>

        <?php if($this->tieneServicios){ ?>
            <table class="center-table">
            <th>Cantidad</th><th>Nombre</th>
            <?php foreach($this->servicios as $s) { ?>
            <tr><td><?=$this->participantes?></td><td><?=$s['nombre']?></td></tr>
            <?php } ?>
            </table>
            
        <?php } else {
            $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
        <?php } ?>

        <?php if($this->tieneHorasAd){ ?>
            <h3>Horas adicionales</h3>
            <table class="center-table">
            <th>Cantidad</th><th>Nombre</th>
            <tr><td><?=$this->cantidadHoras?></td><td>Horas adicionales</td></tr>
            </table>
        <?php } ?>

        <?php if($this->rol == 'encargado') { ?>

        <h3>Lista de mozos seleccionados</h3>
    
        <?php foreach($this->mozos as $mo) { ?>
        <ul>
            <li><?=$mo['apellido'] . ' ' . $mo['nombre']?></li>
        </ul>
        <?php } ?>

        <?php } ?>

        <p class="highlight">A cobrar: $<?=$this->aCobrar * $this->duracion?> ($<?=$this->aCobrar?> por hora) el día <?=$this->fechaACobrar?></p>

        <div>
            <a href="confirmar-evento-empleado-<?=$this->id_evento?>" class="main-btn primary">Confirmar Evento</a>
            <a href="rechazar-evento-empleado-<?=$this->id_evento?>" class="main-btn tertiary">Rechazar Evento</a>
        </div>

        <div>
            <a href="eventos-empleados" class="main-btn secondary">Volver</a>
        </div>

        </div>

        
        

    </div>
    

    

</body>
</html>