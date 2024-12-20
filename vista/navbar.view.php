<!DOCTYPE html>
<!-- DAVID ROMERO -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
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

<nav>
    <div class="left">
        <?php if (isset($_SESSION['usuari'])): ?>
            <a href="<?= $vistaDir ?>/insertar.php">Insertar article</a>
            <a href="<?= $vistaDir ?>/../index.php">Consultar articles</a>
            

        <?php endif; ?>
    </div>

    <div class="right">
        <?php if(isset($_SESSION['usuari']) && !$admin): ?>
            <a href="<?= $vistaDir ?>/profile.php"><button>Perfil</button></a>
            <a href="<?= $vistaDir ?>/reiniciarPassword.php"><button>Canviar contrassenya</button></a>
            <a href="<?= $vistaDir ?>/../controlador/logout.php"><button>Logout</button></a>
        <?php elseif(isset($_SESSION['usuari']) && $admin): ?>
            <a href="<?= $vistaDir ?>/users.php"><button>Usuaris</button></a>
            <a href="<?= $vistaDir ?>/profile.php"><button>Perfil</button></a>
            <a href="<?= $vistaDir ?>/reiniciarPassword.php"><button>Canviar contrassenya</button></a>
            <a href="<?= $vistaDir ?>/../controlador/logout.php"><button>Logout</button></a>
        <?php else:?>
            <a href="<?= $vistaDir ?>/../index.php"><button>Consultar</button></a>
            <a href="<?= $vistaDir ?>/login.php"><button>Login</button></a>
            <a href="<?= $vistaDir ?>/signup.php"><button>Signup</button></a>
        <?php endif; ?>
    </div>
</nav>

</body>
</html>
