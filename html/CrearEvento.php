<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Nuevo Evento</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor">
        <h1>Creación de evento</h1>

        <div class="contenido">
            <p>Cantidad de personas: <?= $this->personas['total'] ?></p>

            <form action="" method="POST" id="form">

                <div>
                    <label for="direccion">Dirección: </label>
                    <input type="text" id="direccion" name="direccion">
                </div>

                <div>
                    <label for="fecha">Fecha y Hora: </label>
                    <input type="datetime-local" id="fecha" name="fecha">
                </div>

                <div>
                    <label for="duracion">Duración (hs): </label>
                    <input type="number" id="duracion" step="0.1" name="duracion">
                </div>


                <div><label for="descripcion">Descripción: </label></div>
                <div><textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea></div>

                <div><input type="hidden" id="fecha-final" value="" name="fechaFinal"></div>

                <div><input type="submit" value="Continuar" class="main-btn primary"
                id="btnContinuar"></div>
            </form>
        </div>

       

    </div>

    <script src="./static/js/crearEvento.js"></script>

</body>
</html>