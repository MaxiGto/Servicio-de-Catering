<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Selección de Mozos</title>
</head>
<body>
    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor">
    <h1 class="center">Selección de mozos para el evento</h1>

    <form action="resumen-evento-<?=$this->id_presupuesto?>" method="POST" class="contenido">
        <p class="bold">Seleccione mozos disponibles en la fecha especificada: </p>
        <?php foreach($this->mozos as $m) { ?>
            <div>
            <input type="checkbox" name="<?=$m['legajo']?>" value="<?=$m['apellido'] . ' ' . $m['nombre']?>" id="<?=$m['legajo']?>"">
            <label for="<?=$m['legajo']?>"><?=$m['apellido'] . ' ' . $m['nombre']?></label>
            </div>
        <?php } ?>
        
        
        <div class="mt-10">
        <input type="submit" value="Ver Resumen" class="main-btn primary">
        <a href="presupuestos-aceptados" class="main-btn secondary">Volver</a>
        </div>
        
    </form>
    

    

</body>
</html>