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

        <h3>Menús solicitados</h3>

        <table class="center-table">
        <th>Cantidad</th><th>Nombre</th>
            <?php 
            
            $total = 0;

            foreach($this->menus as $m){ ?>
                <tr><td><?=$m['cantidad']?></td> <td><?=$m['nombre']?></td></tr>
                <?php $total = $total + $m['cantidad'];
            } ?>
        </table>

        <p><span class="bold">Total:</span> <?= $total ?> menús</p>
        
        <?php if(!$this->sinServicios) { ?>

        <h3>Servicios adicionales solicitados</h3>

        <table class="center-table">
        <th>Nombre</th>
            <?php foreach($this->servicios as $s){ ?>
                <tr><td><?=$s['nombre']?></td></tr>
            <?php } ?>
        </table>

        <?php } ?>

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