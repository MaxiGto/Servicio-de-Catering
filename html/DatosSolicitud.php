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

    <p> 
        <span class="bold">Fecha de solicitud: </span><?=date("d-m-Y", strtotime($this->solicitud['fecha']))?> -
        <span class="bold">Fecha seleccionada para el evento: </span><?=date("d-m-Y", strtotime($this->solicitud['fecha_evento']))?> -
        <span class="bold">Direccion del evento: </span><?=$this->solicitud['direccion']?></p>
    </p>
    
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
        <th>Cantidad</th><th>Nombre</th><th>Precio unitario</th><th>Total</th>
        <?php foreach($this->servicios as $s) { ?>
        <tr> <td> <?=$this->cantidadMenus['total']?> </td> <td> <?=$s['nombre']?> </td> <td> $<?=$s['precio']?> </td> <td> $<?=$s['total']?> </td> </tr>
        <?php } ?>
        </table>

        <p><span class="bold">Total servicios: </span>$<?=$this->totalServicios?></p>

        
    <?php } else {
        $this->mostrarMensaje('No se solicitaron servicios adicionales'); ?>
    <?php } ?>

    <?php if($this->horasAdicionales){ ?>
        <h3>Horas adicionales</h3>
        <table class="center-table">
        <th>Cantidad</th><th>Nombre</th><th>Precio unitario</th><th>Total</th>
        <tr> <td> <?=$this->cantidadHoras?> </td> <td> Horas adicionales </td> <td> $<?=$this->precioHora?> </td> <td> $<?=$this->cantidadHoras * $this->precioHora?> </td> </tr>
        </table>
    <?php } ?>

    <p class="highlight">Total Presupuesto: $<?= $this->totalMenus['total_menus'] + $this->totalServicios + $this->cantidadHoras * $this->precioHora?></p>

    <?php if($this->comentario == "") { ?>
         <p><span class="bold">Comentario: </span>El cliente no hizo ningún comentario </p>
    <?php } else { ?>
        <p><span class="bold">Comentario: </span><?=$this->solicitud['comentario']?></p>
    <?php } ?>

    <a href="agregar-horas-<?=$this->solicitud['id_solicitud']?>" class="main-btn secondary">Agregar horas adicionales</a>

    <form action="confirmar-presupuesto-<?=$this->solicitud['id_solicitud']?>" method="POST">
            
        <label for="observaciones" class="mt-10">Aquí puede escribir observaciones para el cliente: </label>
        <div>
            <textarea name="observaciones" id="comentario" cols="50" rows="10"><?php if($this->horasAdicionales) { ?><?=$this->cantidadHoras?> horas adicionales agregadas por $<?=$this->cantidadHoras * $this->precioHora?><?php } ?>
            </textarea>
        </div>

        <input type="submit" value="Confirmar y enviar presupuesto" class="main-btn primary">
        <div>
            <a href="solicitudes-pendientes" class="main-btn secondary">Volver</a>
            <a href="principal" class="main-btn secondary">Menu Principal</a>
        </div>

        <div><input type="hidden" id="horasAdicionales" value="<?=$this->cantidadHoras?>" name="horasAdicionales"></div>
        <div><input type="hidden" id="precioHorasAd" value="<?=$this->precioHora?>" name="precioHorasAd"></div>

    </form>
    
    <!-- <div>
    <a href="agregar-menus-$this->solicitud['id_solicitud']" class="main-btn secondary">Agregar Menus</a>
    <a href="quitar-menus-$this->solicitud['id_solicitud']" class="main-btn tertiary">Quitar Menus</a>
    </div>

    <div>
        <a href="agregar-servicios-$this->solicitud['id_solicitud']" class="main-btn secondary">Agregar Servicios</a>
        <a href="quitar-servicios-$this->solicitud['id_solicitud']" class="main-btn tertiary">Quitar Servicios</a>
    </div> -->
    </div>
</body>
</html>