<?php
//Incluïm el navbar per poder-nos moure de lloc
include_once 'navbar.view.php';
$cookie_user = isset($_COOKIE['cookie_user']) ? $_COOKIE['cookie_user'] : '';
$cookie_pass = isset($_COOKIE['cookie_password']) ? $_COOKIE['cookie_password'] : '';

include_once '../lib/claus_recaptcha/claus.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <!-- Inputs diversos per poder inserir les dades de l'usuari -->
    <form id="form-login" action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador-login.php'); ?>" method="POST">
        <label for="usuari" aria-label="usuari">
            <input type="text" id="usuari" name="usuari" placeholder="Usuari" value="<?php echo $cookie_user ?>"><br><br>
        </label>

        <label for="contrassenya" aria-label="contrassenya">
            <input type="password" id="contrassenya" name="contrassenya" placeholder="Contrassenya" value="<?php echo $cookie_pass ?>"><br><br>
        </label>

        <label for="rememberMe" aria-label="rememberMe"> Remember Me
            <input type="checkbox" id="rememberMe" name="rememberMe" <?php echo isset($_COOKIE['cookie_user']) ? 'checked' : ''; ?>>
        </label><br><br>

        <div class="botones"><input type="submit" id="login" name="login" value="Log In"><br><br></div>


        <?php if (isset($_SESSION['intents_recaptcha']) && $_SESSION['intents_recaptcha'] >= 3) { ?>
            <div class="g-recaptcha" data-sitekey="<?php echo $clau_publica; ?>" data-callback="enableSubmit"></div>
            <script>
                document.getElementById('login').disabled = true;
            </script>
        <?php } ?>
    </form>

    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../controlador/controlador-github.php'); ?>" method="post">
        <input type="submit" name="github_login" value="Log in with GitHub">
    </form>

    <form action="<?php echo htmlspecialchars(dirname($_SERVER['PHP_SELF']) . '/../vista/forgotPassword.php'); ?>" method="post">
        <input type="submit" id="forgotPassword" name="forgotPassword" value="Has oblidat la contrassenya?">


    </form>

    <script>
        function enableSubmit() {
            document.getElementById('login').disabled = false;
        }
    </script>
</body>

</html>

<?php
include_once '../controlador/controlador-login.php';
?>