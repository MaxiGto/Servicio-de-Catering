<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto</title>
</head>
<body>
    <h1>Selección de Menús</h1>
    <p>Complete las cantidades de los menús que desea para su evento (1 menú por persona)</p>

    <form action="" method="POST">

        
        <?php foreach($this->menus as $m) { ?>

        <p> <?=$m['nombre']?> </p>
        <input type="number" min="0" name="<?=$m['id_menu']?>" value="0">

        <?php } ?>
       

        <input type="submit" value="Confirmar">

    </form>

</body>
</html>