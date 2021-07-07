<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/SiteHeader.css">
    <link rel="stylesheet" href="./static/css/General.css">
    <title>Quitar menús</title>
</head>
<body>

    <?php include '../html/SiteHeader.php' ?>

    <div class="contenedor">
    <h1 class="center">Menús solicitados</h1>

    <div class="contenido">
    <?php foreach($this->menus as $m) { ?>
    <p><?=$m['cantidad']?> <?=$m['nombre']?></p>
    <?php } ?>

    <?php if(!$this->minimo) { ?>
    <form action="" method="POST">
        <label for="menu">Seleccione el menú que desea eliminar: </label>
        <select name="menu" id="menu" class="input-style">
            <option value="" disabled selected>--Seleccione una opción--</option>
            <?php foreach($this->menus as $m) { ?>
            <option value="<?=$m['id_menu']?>"><?=$m['nombre']?></option>
        <?php } ?>
        </select>

    <div>
    <input type="submit" value="Quitar" class="mt-10">
    </div>
    </form>

    <?php } else { 
        $this->mostrarMensaje("La solicitud debe contener al menos 1 tipo de menú");  
    } ?>

    </div>


    <a href="solicitud-<?=$this->idSolicitud?>" class="main-btn primary">Volver</a>

    </div>
    
</body>
</html>