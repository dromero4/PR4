<?php
include '../vista/navbar.view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form action="../controlador/controlador-resetingPassword.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
        <label for="contrassenya1"></label>
        <input type="password" id="contrassenyaReiniciada1" name="contrassenyaReiniciada1" placeholder="Contrassenya"><br><br>

        <label for="contrassenya2"></label>
        <input type="password" id="contrassenyaReiniciada2" name="contrassenyaReiniciada2" placeholder="Confirma la contrassenya"><br><br>

        <input type="submit" id="contrassenyaReiniciada" name="contrassenyaReiniciada" value="Enviar"><br><br>
    </form>
</body>
</html>