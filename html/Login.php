<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/styles.css">
    <link rel="stylesheet" href="./static/css/Login.css">
    <title>Iniciar Sesión</title>
</head>
<body>

    <div class="contenedor">
        <div class="contenedor-form">
            <h3 class="login-title">Ingresa a tu cuenta</h3>
            <form action="" method="POST">
            <?php if($this->error) $this->mostrarMensajeError('Usuario y/o contraseña incorrectos') ?>
                <div>
                    <input 
                        type="text"
                        placeholder="Usuario"
                        autocomplete="off"
                        class="login-input"
                        name="user"
                    />
                </div>

                <div>
                    <input
                        type="password"
                        placeholder="Contraseña"
                        class="login-input"
                        name="password"
                    />
                </div>
                <input 
                    type="submit"
                    value="Ingresar"
                    class="btn-login"
                />
            </form>
        </div>
    </div>

</body>
</html>