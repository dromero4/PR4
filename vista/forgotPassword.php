<?php
include 'navbar.view.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hem oblidat la contrassenya? jajajaj</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h3>Has oblidat la contrassenya?</h3>
    <form action="../controlador/controlador.php" method="post">
        <label for="correu"></label>
        <input type="email" name="correu" id="correu" placeholder="Correu">

        <input type="submit" name="forgotPassword" id="forgotPassword" value="Enviar correu">
    </form>
</body>
</html>