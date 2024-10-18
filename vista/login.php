<?php
include 'navbar.view.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="../controlador/controlador.php" method="post">
        <label for="usuari"></label>
        <input type="text" id="usuari" name="usuari" placeholder="Usuari"><br><br>

        <label for="contrassenya"></label>
        <input type="password" id="contrassenya" name="contrassenya" placeholder="Contrassenya"><br><br>

        <input type="submit" id="login" name="login" value="Log In"><br><br>
    </form>
</body>
</html>

<?php
include 'consultar.php';
?>