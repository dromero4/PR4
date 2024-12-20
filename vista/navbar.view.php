<!DOCTYPE html>
<!-- DAVID ROMERO -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
<?php
require_once __DIR__ . '/../database/env.php';
require_once BASE_PATH . 'model/model.php';
require_once BASE_PATH . 'database/connexio.php';

// Definir la ruta de la carpeta de vistas
$vistaDir = BASE_URL . 'vista';
if(isset($_SESSION['usuari'])){
    $admin = verificarAdmin($connexio, $_SESSION['correu']);
}
?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand ms-2" href='<?= $vistaDir?>/../index.php'>Brand Padel</a>
        <?php if(isset($_SESSION['usuari']) && !$admin): ?>
            <li class="nav-link dropdown" id="drpdwn">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="<?= BASE_PATH?>imagenes/icones/settings-svgrepo-com.svg">
                </a>
                <ul class="dropdown-menu dropdown-menu-end bg-dark">
                    <li><a class="dropdown-item text-white" href="<?= $vistaDir?>/profile.php">Perfil</a></li>
                    <li><a class="dropdown-item text-white" href="<?= $vistaDir?>">Canviar contrasenya</a></li>
                    <li><a class="dropdown-item text-white" href="<?= $vistaDir?>">Logout</a></li>
                </ul>
             </li>
        <?php elseif(isset($_SESSION['usuari']) && $admin): ?>
             <li class="nav-link dropdown" id="drpdwn">
             <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="<?= BASE_PATH?>imagenes/icones/settings-svgrepo-com.svg">
                </a>
                <ul class="dropdown-menu dropdown-menu-end bg-dark">
                    <li><a class="dropdown-item text-white" href="#">Usuaris</a></li>
                    <li><a class="dropdown-item text-white" href="<?= $vistaDir?>/profile.php">Perfil</a></li>
                    <li><a class="dropdown-item text-white" href="#">Canviar contrasenya</a></li>
                    <li><a class="dropdown-item text-white" href="#">Logout</a></li>
                </ul>
             </li>
        <?php else:?>
            <li class="nav-link dropdown" id="drpdwn">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Get ready with us</a>
                <ul class="dropdown-menu dropdown-menu-end bg-dark">
                    <li><a class="dropdown-item text-white" href="#">Login</a></li>
                    <li><a class="dropdown-item text-white" href="#">Signup</a></li>
                </ul>
             </li>
        <?php endif; ?>
    </div>
</nav>

</body>
</html>
