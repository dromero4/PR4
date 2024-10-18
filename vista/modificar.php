<?php
session_start();
include 'navbar.view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar article</title>
</head>
<body>
    <h3>Quin article vols modificar?</h3>
    <form action="../controlador/controlador.php" method="POST">
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