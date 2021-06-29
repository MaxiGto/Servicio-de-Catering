<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen</title>
</head>
<body>
    <h1>Resumen de presupuesto</h1>

    <h3>Menús solicitados</h3>

    <ul>
        <?php 
        
        $total = 0;

        foreach($this->menus as $m){ ?>
            <li> <?=$m['cantidad']?> <?=$m['nombre']?>  </li>
            <?php $total = $total + $m['cantidad'];
        } ?>
    </ul>

    <p>Total: <?= $total ?> menús</p>

    <h3>Servicios adicionales solicitados</h3>

    <ul>
        <?php foreach($this->servicios as $s){ ?>
            <li> <?=$s['nombre']?>  </li>
        <?php } ?>
    </ul>

    <form action="" method="POST">
        
        <label for="comentario">Aquí puede escribirnos algún comentario adicional: </label>
        <div>
            <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea>
        </div>

        <a href="catalogo">Volver al inicio</a>
        <a href="menus-presupuesto">Rehacer presupuesto</a>
        <input type="submit" value="Solicitar presupuesto">

    </form>

    
</body>
</html>