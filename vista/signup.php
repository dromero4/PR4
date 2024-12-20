<?php 
//Incluïm el navbar per poder-nos moure de lloc
include_once 'navbar.view.php';

//Variables perque en cas d'equivocar-se, es quedi al input el que hem ficat perque no s'esborri
$correu = isset($_POST['correu']) ? $_POST['correu'] : '';
$usuari = isset($_POST['usuari']) ? $_POST['usuari'] : '';
$contrassenya = isset($_POST['contrassenya']) ? $_POST['contrassenya'] : '';
$contrassenya2 = isset($_POST['contrassenya2']) ? $_POST['contrassenya2'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador.php'); ?>" method="post">
        <label for="correu"></label>
        <input type="text" id="correu" name="correu" placeholder="Correu" value="<?php echo htmlspecialchars($correu); ?>"><br><br>

        <label for="usuari"></label>
        <input type="text" id="usuari" name="usuari" placeholder="Usuari" value="<?php echo htmlspecialchars($usuari); ?>"><br><br>

        <label for="contrassenya"></label>
        <input type="password" id="contrassenya" name="contrassenya" placeholder="Contrassenya" value="<?php echo htmlspecialchars($contrassenya); ?>"><br><br>

        <label for="contrassenya2"></label>
        <input type="password" id="contrassenya2" name="contrassenya2" placeholder="Contrassenya" value="<?php echo htmlspecialchars($contrassenya2); ?>"><br><br>

        <label for="fotoPerfil">
        <input type="text" name="imagenPerfil" placeholder="URL de la imatge">
        </label>

        <input type="submit" id="login" name="login" value="Sign Up">
    </form>
</body>
</html>

<?php

?>