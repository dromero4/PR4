<?php
include_once 'navbar.view.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h3>Has oblidat la contrassenya?</h3>
    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador-forgotPassword.php'); ?>" method="post">
        <label for="correu"></label>
        <input type="text" name="correu" id="correu" placeholder="Correu">

        <input type="submit" name="forgotPassword" id="forgotPassword" value="Enviar correu">
    </form>
</body>
</html>