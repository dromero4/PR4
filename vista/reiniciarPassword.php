<?php 
session_start();
include_once 'navbar.view.php';
?>
<!DOCTYPE html>
<!-- DAVID ROMERO -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reiniciar Password</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Formulari per reinciiar el password -->
    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador-reiniciarPassword.php'); ?>" method="post">
    <label for="correu"></label>
        <label for="contrassenya"></label>
        <input type="password" id="contrassenya" name="contrassenya" placeholder="Contrassenya actual" value=""><br><br>

        <label for="contrassenya2"></label>
        <input type="password" id="contrassenyaCanviar" name="contrassenyaCanviar" placeholder="Nova contrassenya" value=""><br><br>

        <input type="submit" id="reiniciarPassword" name="reiniciarPassword" value="Enviar">
    </form>
</body>
</html>