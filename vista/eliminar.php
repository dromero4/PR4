<?php
session_start();
include 'navbar.view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar article</title>
</head>
<body>
    <h3>Quin article vols esborrar? </h3>
    <form action="../controlador/controlador.php" method="POST">
        <label for="id"></label>
        <input type="number" name="id" placeholder="ID: ">

        <input type="submit" name="Enviar" value="Eliminar">
    </form>
</body>
</html>