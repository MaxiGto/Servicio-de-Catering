<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Resumen</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
        <h1>Resumen de presupuesto</h1>

        <p><span class="bold">Fecha:</span> <?= $this->fechaEvento ?></p>
        <p><span class="bold">Turno:</span> <?= $this->turno . " (" . $this->horario  . ")"?></p>

        <h3>Menús solicitados</h3>

        <table class="center-table">
        <th>Cantidad</th><th>Nombre</th><th>Precio Unitario</th><th>Total</th>
            <?php 
            foreach($this->menus as $m){ ?>
                <tr><td><?=$m['cantidad']?></td> <td><?=$m['nombre']?></td><td><?="$" . $m['precio']?><td><?="$" . ($m['cantidad'] * $m['precio'])?></td></tr>
                <?php $this->cantidadMenus = $this->cantidadMenus + $m['cantidad'];
                $this->totalPresupuesto = $this->totalPresupuesto + ($m['cantidad'] * $m['precio']);
            } ?>
        </table>

        <p><span class="bold">Total:</span> <?= $this->cantidadMenus ?> menús</p>
        
        <?php if(!$this->sinServicios) { ?>

        <h3>Servicios adicionales solicitados</h3>

        <table class="center-table">
        <th>Cantidad</th><th>Nombre</th><th>Precio Unitario</th><th>Total</th>
            <?php foreach($this->servicios as $s){ ?>
                <tr><td><?=$this->cantidadMenus?></td><td><?=$s['nombre']?></td><td><?="$" . $s['precio']?><td><?="$" . ($this->cantidadMenus * $s['precio'])?></td></tr>
                <?php $this->totalPresupuesto = $this->totalPresupuesto + ($this->cantidadMenus * $s['precio']); ?>
            <?php } ?>
        </table>

        <?php } ?>

        <p>Recuerde que se cobra 1 servicio adicional por cada menú solicitado</p>

        <p class="highlight">Total: <span class="bold">$<?= $this->totalPresupuesto ?></span></p>

        <form action="" method="POST">
            
            <label for="comentario" class="mt-10">Aquí puede escribirnos algún comentario adicional: </label>
            <div>
                <textarea name="comentario" id="comentario" cols="50" rows="10"></textarea>
            </div>

            <a href="principal" class="main-btn secondary">Volver al inicio</a>
            <a href="menus-presupuesto" class="main-btn secondary">Rehacer presupuesto</a>
            <input type="submit" value="Solicitar presupuesto" class="main-btn primary">

        </form>
    </div>

    
</body>
</html>