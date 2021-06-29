<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quitar menús</title>
</head>
<body>
    <h1>Menús solicitados</h1>

    <h3>Menús solicitados</h3>
    <?php foreach($this->menus as $m) { ?>
    <p><?=$m['cantidad']?> <?=$m['nombre']?></p>
    <?php } ?>
    
</body>
</html>