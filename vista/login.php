<?php
//Incluïm el navbar per poder-nos moure de lloc
include_once 'navbar.view.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <!-- Inputs diversos per poder inserir les dades de l'usuari -->
    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador.php'); ?>" method="post">
        <label for="usuari"></label>
        <input type="text" id="usuari" name="usuari" placeholder="Usuari"><br><br>

        <label for="contrassenya"></label>
        <input type="password" id="contrassenya" name="contrassenya" placeholder="Contrassenya"><br><br>

        <input type="checkbox" id="rememberMe"> Remember Me<br><br>

        <input type="submit" id="login" name="login" value="Log In"><br><br>
    </form>

    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../vista/forgotPassword.php'); ?>" method="post">
        <input type="submit" id="forgotPassword" name="forgotPassword" value="Has oblidat la contrassenya?">
    </form>
    
</body>
</html>

<?php
    
?>