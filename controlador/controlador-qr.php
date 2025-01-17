<?php
use chillerlan\QRCode\QRCode;

require_once '../lib/vendor/autoload.php';
require_once __DIR__ . '/../database/env.php';
require_once BASE_PATH . '/database/connexio.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id_qr = htmlspecialchars($_GET['id']);
    $model_qr = htmlspecialchars($_GET['model']);
    $nom_qr = htmlspecialchars($_GET['nom']);
    $preu_qr = htmlspecialchars($_GET['preu']);
    $correu_qr = htmlspecialchars($_GET['correu']);

    $qr_link = "https://www.davidromero.cat/controlador/controlador-qr.php?id=$id_qr&model=$model_qr&nom=$nom_qr&preu=$preu_qr&correu=$correu_qr";

    echo '<img class="DivQR" src="'.(new QRCode)->render($qr_link).'" width=300px alt="QR Code" />';

}
?>