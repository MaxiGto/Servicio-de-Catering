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
    <h1>Selección de fecha</h1>
    <div class="contenido">
        <h3>Seleccione la fecha y franja horaria en que desea su evento</h3>

            <form action="" method="POST">

            <div>
                <label for="fecha">Fecha: </label>
                <input type="date" id="fecha" name="fecha">
            </div>

            <div>
                <label for="turno">Turno: </label>
                <select name="turno" id="turno" class="input-style">

                    <option value="<?='1'?>"> Mañana: 8 a 14hs </option>
                    <option value="<?='2'?>"> Tarde: 14 a 20hs </option>
                    <option value="<?='3'?>"> Noche: 20 a 02 hs </option>

                </select>
            </div>

            <input type="submit" value="Confirmar">

        </form>

        <div>
        <a href="principal" class="main-btn secondary">Volver</a>
        </div>
    </div>
    </div>

</body>
</html>