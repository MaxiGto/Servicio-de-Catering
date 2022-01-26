<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Horas adicionales</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
    <h1>Agregar horas adicionales</h1>

    <div class="contenido">
    <form action="" method="POST">

        <div>
            <label for="horas">Indique la cantidad de horas extra que desea agregar al presupuesto: </label>
            <input type="number" min="0" id="horas" name="horas">
        </div>

        <div>
            <label for="precio">Indique el precio por hora: </label>
            <input type="number" min="0" id="precio" name="precio">
        </div>

        <div>
            <input type="submit" value="Agregar horas" class="mt-10">
        </div>
    </form>

    <?php if($this->error) $this->mostrarMensajeError('Cantidad de horas y/o precio ingresados son inválido/s ') ?>
    </div>

    <a href="principal" class="main-btn primary">Menú Principal</a>
    </div>


</body>
</html>