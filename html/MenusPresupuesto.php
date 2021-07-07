<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Presupuesto</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor">
    <h1 class="center">Selección de Menús</h1>

    <div class="contenido">
    <h3>Complete las cantidades de los menús que desea para su evento (1 menú por persona)</h3>

    
    <form action="" method="POST">

        
        <?php foreach($this->menus as $m) { ?>

        <p class="bold"> <?=$m['nombre']?> </p>
        <input type="number" min="0" name="<?=$m['id_menu']?>" value="0" class="input-style">

        <?php } ?>

        <?php if($this->error) $this->mostrarMensajeError('Debe seleccionar al menos 1 menú') ?>
       
        <div>
        <a href="principal" class="main-btn secondary">Menú Principal</a>
        <input type="submit" value="Confirmar" class="main-btn primary">
        </div>
    </form>
    </div>
    </div>

</body>
</html>