<!DOCTYPE html>
<!-- DAVID ROMERO -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php

// Definir la ruta de la carpeta de vistas
$vistaDir = "../vista";
?>

<nav>
    <div class="left">
        <?php if (isset($_SESSION['usuari'])): ?>
            <a href="<?= $vistaDir ?>/insertar.php">Insertar</a>
            <a href="<?= $vistaDir ?>/modificar.php">Modificar</a>
            <a href="<?= $vistaDir ?>/eliminar.php">Eliminar</a>
            <a href="<?= $vistaDir ?>/consultar.php">Consultar</a>
            

        <?php endif; ?>
    </div>

    <div class="right">
        <?php if (isset($_SESSION['usuari'])): ?>
            <a href="../controlador/logout.php"><button>Logout</button></a>
            <a href="<?= $vistaDir ?>/reiniciarPassword.php"><button>Canviar contrassenya</button></a>
        <?php else: ?>
            <a href="<?= $vistaDir ?>/login.php"><button>Login</button></a>
            <a href="<?= $vistaDir ?>/signup.php"><button>Signup</button></a>
        <?php endif; ?>
    </div>
</nav>

</body>
</html>

