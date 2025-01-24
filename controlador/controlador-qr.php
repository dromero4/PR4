<?php

require_once '../model/model.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_qr = htmlspecialchars($_GET['id']);
    $model_qr = htmlspecialchars($_GET['model']);
    $nom_qr = htmlspecialchars($_GET['nom']);
    $preu_qr = htmlspecialchars($_GET['preu']);
    $correu_qr = htmlspecialchars($_GET['correu']);

    $qr_link = "https://www.davidromero.cat/vista/vista-qr.php?id=$id_qr&model=$model_qr&nom=$nom_qr&preu=$preu_qr&correu=$correu_qr";

    $show_qr = showQR($qr_link);
}

include_once '../vista/vista-qr.php';
