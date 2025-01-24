<?php
include_once 'navbar.view.php';
require_once '../controlador/controlador-qr.php';
session_start();

$modelo_qr = $_GET['model'] ?? null;
$nom_qr = $_GET['nom'] ?? null;
$preu_qr = $_GET['preu'] ?? null;
$correu_qr = $_GET['correu'] ?? null;
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
    <div class="info-container mt-4">
        <div class="image mt-4">
            <?= $show_qr ?>
        </div>
        <div class="info-qr mt-4">
            <p><strong>Modelo: </strong><?= $modelo_qr ?></p> <!-- modelo -->
            <hr>
            <p><strong>Nombre: </strong><?= $nom_qr ?></p> <!-- nombre -->
            <hr>
            <p><strong>Precio: </strong> <?= $preu_qr ?>€</p> <!-- precio -->
            <hr>
            <p><strong>Correo: </strong> <?= $correu_qr ?></p> <!-- correo -->
            <hr>
        </div>
        <button class="btn btn-secondary mb-4">Guardar</button>
    </div>
</body>

</html>