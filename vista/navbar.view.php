<!DOCTYPE html>
<!-- DAVID ROMERO -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $currentDir = dirname($_SERVER['PHP_SELF']); // Obté el directori actual

    // Comprobar si estàs a controlador.php per poder ajustar la ruta a la carpeta vista
    if (basename($currentDir) == 'controlador') {
        $vistaDir = '../vista'; // baixar un nivell per poder entrar a la vista
    } else {
        $vistaDir = $currentDir; // Mantener la ruta actual para otros archivos en la carpeta vista
    }
    ?>
    <?php if (isset($_SESSION['usuari'])): // Si l'usuari està loguejat ?>
        <a href="<?= $vistaDir ?>/insertar.php"><button>Insertar</button></a>
        <a href="<?= $vistaDir ?>/modificar.php"><button>Modificar</button></a>
        <a href="<?= $vistaDir ?>/eliminar.php"><button>Eliminar</button></a>
        <a href="<?= $vistaDir ?>/consultar.php"><button>Consultar</button></a>
        <a href="../controlador/logout.php"><button>Logout</button></a>
    <?php else: // Si l'usuari no està loguejat ?>
        <a href="<?= $vistaDir ?>/login.php"><button>Login</button></a>
        <a href="<?= $vistaDir ?>/signup.php"><button>Signup</button></a>
    <?php endif; ?>
    <br><br>
</body>
</html>

