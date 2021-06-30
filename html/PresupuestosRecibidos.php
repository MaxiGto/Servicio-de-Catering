<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuestos</title>
</head>
<body>
    <h1>Presupuestos Recibidos</h1>

    <h3> <?= $this->cantidad ?> presupuestos recibidos </h3>

    <table>
    
    <?php foreach($this->presupuestos as $p) { ?>
        <hr/>
        <p> <span><?= $p['fecha'] ?></span> <a href="presupuesto-<?=$p['id_presupuesto']?>">Ver presupuesto</a></p>
        <hr/>
    <?php } ?>

    </table>


</body>
</html>