<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
</head>
<body>
    <h1>Datos del cliente</h1>
    <img src="static/img/profile-picture.png" alt="Foto de perfil">
    <p><span>Usuario: </span> <?= $this->cliente['usuario'] ?> </p>
    <hr/>
    <p><span>Nombre: </span> <?= $this->cliente['nombre'] ?> </p>
    <hr/>
    <p><span>Apellido: </span> <?= $this->cliente['apellido'] ?> </p>
    <hr/>
    <p><span>Email: </span> <?= $this->cliente['email'] ?> </p>
    <hr/>
    <p><span>Teléfono: </span> <?= $this->cliente['telefono'] ?> </p>
</body>
</html>