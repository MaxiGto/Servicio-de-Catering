<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Cliente</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor center">
    <h1>Datos del cliente</h1>
    <img src="static/img/profile-picture.png" alt="Foto de perfil">
    <p><span class="bold">Usuario: </span> <?= $this->cliente['usuario'] ?> </p>
    <hr/>
    <p><span class="bold">Nombre: </span> <?= $this->cliente['nombre'] ?> </p>
    <hr/>
    <p><span class="bold">Apellido: </span> <?= $this->cliente['apellido'] ?> </p>
    <hr/>
    <p><span class="bold">Email: </span> <?= $this->cliente['email'] ?> </p>
    <hr/>
    <p><span class="bold">Teléfono: </span> <?= $this->cliente['telefono'] ?> </p>

    <a href="solicitudes-pendientes" class="main-btn primary center">Volver</a>

    </div>
</body>
</html>