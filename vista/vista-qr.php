<?php 
include_once 'navbar.view.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/qr-styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body> 
    <div class="center">
        <div class="qr-container">
            <div class="image">
                <img src="../imagenes/fotoPredeterminada.webp">
            </div>
            <div class="info-container">
                <p><strong>Modelo: </strong></p> <!-- modelo -->
                <hr>
                <p><strong>Nombre: </strong></p> <!-- nombre -->
                <hr>
                <p><strong>Precio: </strong></p> <!-- precio -->
                <hr>
                <p><strong>Correo: </strong></p> <!-- correo -->
                <hr>
            </div>
            <div class="botones-qr">
                <input type="submit" value="hola">
            </div>
        </div>
    </div>
    
</body>
</html>