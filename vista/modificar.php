<?php
//DAVID ROMERO
session_start();
//Incluïm el navbar per poder-nos moure de lloc
include_once 'navbar.view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar article</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <!-- Inputs diversos per modificar els articles -->
    <h3>Quin article vols modificar?</h3>
    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador.php'); ?>" method="POST">
        <label for="id"></label>
        <input type="number" id="id" name="id" placeholder="ID: "><br><br>

        <label for="model"></label>
        <input type="text" id="model" name="model" placeholder="Model: "><br><br>

        <label for="nom"></label>
        <input type="text" id="nom" name="nom" placeholder="Nom: "><br><br>

        <label for="preu"></label>
        <input type="number" id="preu" name="preu" placeholder="Preu: "><br><br>

        <input type="submit" name="Enviar" value="Modificar">
    </form>
</body>
</html>