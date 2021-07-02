<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Menú Principal</title>
</head>
<body>
    <h1>Bienvenido al sistema de gestión de Catering Essen</h1>

    <?php if($this->rol == 'cliente') { ?>

        <div class="contenedor">
        <h3 class="center">Seleccione la opción deseada</h3>
            <div class="contenido center">
                <a href="catalogo" class="main-btn secondary">Ver catálogo de menús y servicios adicionales</a>
                <div>
                <a href="menus-presupuesto" class="main-btn">Elaborar presupuestos</a>
                <a href="presupuestos-recibidos" class="main-btn">Ver y confirmar presupuestos</a>
                </div>
            </div>
        </div>

    <?php } ?>

    <?php if($this->rol == 'admin') { ?>

    <div class="contenedor">
    <h3 class="center">Seleccione la opción deseada</h3>
        <div class="contenido">
            <a href="catalogo">Ver catálogo de menús y servicios adicionales</a>
            <a href="solicitudes-pendientes">Ver solicitudes pendientes</a>
        </div>
    </div>

<?php } ?>

    
</body>
</html>