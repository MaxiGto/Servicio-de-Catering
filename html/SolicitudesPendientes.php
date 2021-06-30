<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes</title>
</head>
<body>
    <h1>Solicitudes Pendientes</h1>

    <h3> <?= $this->cantidad ?> solicitudes pendientes </h3>

    <table>
    
    <?php foreach($this->solicitudes as $s) { ?>
        <hr/>
        <p> <span><?= $s['fecha'] ?></span> <a href="solicitud-<?=$s['id_solicitud']?>">Ver solicitud</a> <a href="cliente-<?=$s['id_cliente']?>">Ver cliente</a></p>
        <hr/>
    <?php } ?>

    </table>

    <a href="catalogo">Menú Principal</a>


</body>
</html>