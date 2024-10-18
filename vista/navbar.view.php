

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($_SESSION['usuario'])): // Si el usuario está logueado ?>
        <a href="insertar.php"><button>Insertar</button></a>
        <a href="modificar.php"><button>Modificar</button></a>
        <a href="eliminar.php"><button>Eliminar</button></a>
        <a href="consultar.php"><button>Consultar</button></a>
    <?php else: // Si el usuario no está logueado ?>
        <a href="login.php"><button>Login</button></a>
        <a href="signup.php"><button>Signup</button></a>
    <?php endif; ?>
    <br><br>
</body>
</html>