<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estils/estilsFormularis.css">
    <title>Document</title>
</head>
<body>
    <div class="DivQR">
    <?php

    use chillerlan\QRCode\QRCode;

    require_once "../lib/vendor/autoload.php";

    echo '<img class="DivQR" src="'.(new QRCode)->render("https://www.google.com").'" width=300px alt="QR Code" />'
    ?>
    </div>
</body>
</html>