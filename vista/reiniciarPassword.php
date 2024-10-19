<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reiniciar Password</title>
</head>
<body>
    <form action="../controlador/controlador.php" method="post">
    <label for="correu"></label>
        <input type="text" id="correu" name="correu" placeholder="Correu" value=""><br><br>

        <label for="contrassenya"></label>
        <input type="password" id="contrassenya" name="contrassenya" placeholder="Contrassenya" value=""><br><br>

        <label for="contrassenya2"></label>
        <input type="password" id="contrassenyaCanviar" name="contrassenyaCanviar" placeholder="Contrassenya" value=""><br><br>

        <input type="submit" id="reiniciarPassword" name="reiniciarPassword" value="reiniciarPassword">
    </form>
</body>
</html>