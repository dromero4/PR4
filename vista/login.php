<?php
//Incluïm el navbar per poder-nos moure de lloc
include 'navbar.view.php';
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
    <form action="../controlador/controlador.php" method="post">
        <label for="usuari"></label>
        <input type="text" id="usuari" name="usuari" placeholder="Usuari"><br><br>

        <label for="contrassenya"></label>
        <input type="password" id="contrassenya" name="contrassenya" placeholder="Contrassenya"><br><br>

        <input type="submit" id="login" name="login" value="Log In"><br><br>

        
    </form>

    <!-- En cas de voler canviar la contrassenya -->
    <a href="reiniciarPassword.php"><button>Vols canviar la contrassenya?</button></a><br><br>
</body>
</html>

<?php
//incluim els articles perque l'usuari no logat els pugui veure
include 'consultar.php';
?>