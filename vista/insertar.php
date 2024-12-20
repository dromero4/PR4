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
    <title>Insertar article</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
    <h3 style="color: white">Quin element vols inserir? </h3>
    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador.php'); ?>" method="POST">
        <label for="model"></label>
        <!-- input per inserir el model de l'article -->
        <input type="text" id="model" name="model" placeholder="Model: "><br><br>

        <label for="nom"></label>
        <!-- input per inserir el nom de l'article -->
        <input type="text" id="nom" name="nom" placeholder="Nom: "><br><br>

        <label for="preu"></label>
        <!-- input per inserir el preu de l'article -->
        <input type="number" id="preu" name="preu" placeholder="Preu: "><br><br>

        <!-- botó type submit -->
        <input type="submit" name="Enviar" value="Insertar">
    </form>
</body>
</html>