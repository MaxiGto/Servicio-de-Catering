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
        
        <p><span class="bold">Encargado/a:</span> <?=$this->encargado?></p>
        <p><span class="bold">Dirección:</span> <?=$this->direccion?></p>
        <p><span class="bold">Fecha y hora:</span> <?=$this->fechaHora?> hs</p>
        <p><span class="bold">Duración:</span> <?=$this->duracion?> hs</p>
        <p><span class="bold">Participantes:</span> <?=$this->participantes?> personas</p>

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
            <th>Nombre</th>
            <?php foreach($this->servicios as $s) { ?>
            <tr><td><?=$s['nombre']?></td></tr>
            <?php } ?>
            </table>
            
        <?php } else {
            $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
        <?php } ?>

        <?php if($this->rol == 'encargado') { ?>

        <h3>Lista de mozos seleccionados</h3>
    
        <?php foreach($this->mozos as $mo) { ?>
        <ul>
            <li><?=$mo['apellido'] . ' ' . $mo['nombre']?></li>
        </ul>
        <?php } ?>

        <?php } ?>

        <p class="highlight">A cobrar: $<?=$this->aCobrar * $this->duracion?> ($<?=$this->aCobrar?> por hora)</p>

        <div>
            <a href="eventos-confirmados-empleados" class="main-btn secondary">Volver</a>
        </div>

        </div>

        
        

    </div>
    

    

</body>
</html>