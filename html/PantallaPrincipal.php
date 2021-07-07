<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Menú Principal</title>
</head>
<body>
    <?php include '../html/SiteHeader.php' ?>
    <h1 class="center">¡Bienvenido al sistema de gestión de Catering Essen!</h1>

    <?php if($this->rol == 'cliente') { ?>

        <div class="contenedor">
        <h3 class="center">Seleccione la opción deseada</h3>
            <div class="contenido center">
                <a href="catalogo" class="main-btn menu-btn secondary">Ver catálogo de menús y servicios adicionales</a>
                <div>
                <a href="menus-presupuesto" class="main-btn menu-btn primary">Elaborar presupuestos</a>
                <a href="presupuestos-recibidos" class="main-btn menu-btn primary">Ver y confirmar presupuestos</a>
                </div>
            </div>
        </div>

    <?php } ?>

    <?php if($this->rol == 'admin') { ?>

    <div class="contenedor">
    <h3 class="center">Seleccione la opción deseada</h3>
        <div class="contenido center">
            <div>
            <a href="catalogo" class="main-btn menu-btn secondary">Ver catálogo de menús y servicios adicionales</a>
            <a href="actualizar-precio-menu" class="main-btn menu-btn secondary">Actualizar precios de menús</a>
            </div>
            <a href="solicitudes-pendientes" class="main-btn menu-btn primary">Ver solicitudes pendientes</a>
        </div>
    </div>

<?php } ?>

    
</body>
</html>