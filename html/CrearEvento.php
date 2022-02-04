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
            <h3>Datos del cliente</h3>
            <p>
                <span class="bold">Nombre: </span><?=$this->cliente['nombre'] . " " . $this->cliente['apellido']?> - 
                <span class="bold">Usuario: </span><?=$this->cliente['usuario']?> -
                <span class="bold">Email: </span><?=$this->cliente['email']?> - 
                <span class="bold">Teléfono: </span><?=$this->cliente['telefono']?>
            </p>
            
            <h3>Información del evento</h3>
            <p>
                <span class="bold">Fecha:</span> <?=$this->solicitud['fecha_evento']?> -
                <span class="bold">Turno:</span> <?= $this->turno['nombre'] ?> - 
                <span class="bold">Cantidad de personas:</span> <?= $this->personas['total'] ?> - 
                <span class="bold">Dirección:</span> <?= $this->solicitud['direccion'] ?> - 
                <?php if(trim($this->solicitud['comentario']) != ""){ ?>
                    <span class="bold">Comentarios del cliente: </span> <?= $this->solicitud['comentario'] ?> -
                <?php } else { ?>
                    <span class="bold">Comentarios del cliente: </span> No se hicieron comentarios -
                <?php } ?>
                <?php if(trim($this->solicitud['observaciones']) != ""){ ?>
                    <span class="bold">Observaciones del administrador: </span> <?= $this->solicitud['observaciones'] ?>
                <?php } else { ?>
                    <span class="bold">Observaciones del administrador: </span> No se hicieron observaciones 
                <?php } ?>
            </p>


            <form action="seleccionar-encargado-<?=$this->id_presupuesto?>" method="POST" id="form">

                <div><label for="descripcion">Añada una descripción para el evento: </label></div>
                <div><textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea></div>


                
                <div>
                <a href="presupuestos-aceptados" class="main-btn secondary">Volver</a>
                <input type="submit" value="Continuar" class="main-btn primary"
                id="btnContinuar"></div>
            </form>
        </div>

       

    </div>

    <script src="./static/js/crearEvento.js"></script>

</body>
</html>