<?php
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/RegistroCliente.css">
    <title>Registro de cliente</title>
</head>
<body>

    <div class="contenedor">
        <div class="contenedor-form">
        <h1>Crear una cuenta</h1>
        <?php if($this->error) $this->mostrarMensajeError('Por favor revise los datos de registro') ?>
        <form action="" method="POST" class="formulario">
            <div>
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre" class="input-registro" autocomplete="off">
            </div>

            <div>
                <label for="apellido">Apellido: </label>
                <input type="text" id="apellido" name="apellido" class="input-registro" autocomplete="off">
            </div>

            <div>
                <label for="email">Correo: </label>
                <input type="email" id="email" name="email" class="input-registro" autocomplete="off">
            </div>

            <div>
                <label for="telefono">Teléfono: </label>
                <input type="tel" id="telefono" name="telefono" class="input-registro" autocomplete="off">
            </div>

            <div>
                <label for="usuario">Nombre de usuario: </label>
                <input type="text" id="usuario" name="usuario" class="input-registro" autocomplete="off"> 
            </div>

            <div>
                <label for="password">Contraseña: </label>
                <input type="password" id="password" name="password" class="input-registro">
            </div>

            <div>
                <label for="password2">Confirmar contraseña: </label>
                <input type="password" id="password2" name="password2" class="input-registro">
            </div>

            <div>
                <input type="submit" id="registrar" value="Registrarse" class="btn">
            </div>
            
            
        </form>
        </div>
    </div>
</body>
</html>