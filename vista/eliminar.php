<?php
session_start();
//Inserim la navbar per poder-nos moure de lloc
include_once 'navbar.view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar article</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h3>Quin article vols esborrar? </h3>
    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador.php'); ?>" method="POST">
        <label for="id"></label>
        <!-- input per inserir l'ID -->
        <input type="number" name="id" placeholder="ID: "> 

        <!-- Botó per submit -->
        <input type="submit" name="Enviar" value="Eliminar">
    </form>
</body>
</html>