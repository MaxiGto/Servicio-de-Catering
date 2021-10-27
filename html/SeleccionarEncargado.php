<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Selección de Encargado</title>
</head>
<body>
    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor">
    <h1 class="center">Selección de encargado para el evento</h1>

    <form action="seleccionar-mozos-<?=$this->id_presupuesto?>" method="POST" class="contenido">
        <label for="menu" class="bold">Seleccione uno de los encargados disponibles en la fecha especificada: </label>
        <select name="encargado" id="encargado" class="input-style">
            <?php foreach($this->encargados as $e) { ?>
            <option value="<?=$e['legajo']?>"><?=$e['apellido'] . ' ' . $e['nombre']?></option>
        <?php } ?>
        </select>
        
        <div class="mt-10">
        <input type="submit" value="Continuar" class="main-btn primary">
        <a href="presupuestos-aceptados" class="main-btn secondary">Volver</a>
        </div>
        
    </form>
    

    

</body>
</html>