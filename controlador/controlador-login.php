<?php
session_start();
include_once '../lib/claus_recaptcha/claus.php';
require_once '../model/model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verificar si los campos de usuario y contraseña están vacíos
    if (!empty($usuari) && !empty($contrassenya)) {
        // Verificar las credenciales del usuario
        if (verificarCompte($usuari, $contrassenya, $connexio)) {
            // Si las credenciales son correctas
            $_SESSION['intents_recaptcha'] = 0; // Reseteamos el contador de intentos fallidos
            $_SESSION['fotoPerfil'] = $imatgePerfil;

            // Establecer el tiempo de expiración de la sesión a 40 minutos
            $timeout_duration = 40 * 60;

            // Verificar si hay una sesión activa
            if (isset($_SESSION['LAST_ACTIVITY'])) {
                // Calcular el tiempo transcurrido desde la última actividad
                $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];

                // Si ha pasado más tiempo del límite establecido, cerrar la sesión
                if ($elapsed_time > $timeout_duration) {
                    session_unset(); // Elimina las variables de sesión
                    session_destroy(); // Destruye la sesión
                    header("Location: ../vista/login.php"); // Redirige a la página de login
                    exit;
                }
            }

            // Actualizar la última actividad
            $_SESSION['LAST_ACTIVITY'] = time();

            // Variables del usuario
            $_SESSION['usuari'] = $usuari;
            $resultatCorreu = seleccionarCorreu($usuari, $connexio);
            $_SESSION['correu'] = $resultatCorreu['correu'];

            var_dump($_SESSION['correu']);
            //Generar i insertar l'api-token a la base de dades de l'usuari
            $token_api = generarToken($connexio, $resultatCorreu);

            if (verificarToken($token_api, $_SESSION['correu'], $connexio)) {
                var_dump($token_api);
            } else {
            }

            // Recordar al usuario (Remember Me)
            $remember = $_POST['rememberMe'] ?? null;
            if ($remember === 'on') {
                // Si está marcado, guardar las cookies
                setcookie('cookie_user', $usuari, time() + 60 * 60 * 24 * 30, "/"); // 1 mes
                setcookie('cookie_password', $contrassenya, time() + 60 * 60 * 24 * 30, "/");
            } else {
                // Si no está marcado, eliminar las cookies
                unset($_COOKIE['cookie_user']);
                unset($_COOKIE['cookie_password']);
            }

            // Redirigir a la página principal si ya está logueado
            if (isset($_SESSION['usuari'])) {
                header('Location:../index.php');
            }
        } else {
            // Si la contraseña es incorrecta
            $missatges[] = "Contrassenya incorrecte";

            // Incrementar los intentos fallidos
            $_SESSION['intents_recaptcha'] = ($_SESSION['intents_recaptcha'] ?? 0) + 1;

            // Si hemos alcanzado 3 intentos fallidos, activar el reCAPTCHA
            if ($_SESSION['intents_recaptcha'] >= 3) {
                if (!recaptcha($clau_privada)) {
                    $missatges[] = "ReCAPTCHA no validat ";
                } else {
                    $missatges[] = "ReCAPTCHA validat!";
                }
            }
        }
    } else {
        // Si no se han rellenado los campos de usuario y contraseña
        $missatges[] = "Has d'introduïr les dades";
    }

    // Función de verificación del reCAPTCHA
    function recaptcha($clau_privada)
    {
        $recaptcha = false;

        // Obtener el token reCAPTCHA enviado desde el formulario
        $recaptcha_token = $_POST['g-recaptcha-response'] ?? null;

        // Verificar si el token reCAPTCHA está presente
        if (empty($recaptcha_token)) {
            return false;
            exit();
        }

        // URL de la API de Google para verificar el token
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        // Realizar la solicitud POST a Google para verificar el token
        $respuesta = file_get_contents("$url?secret=$clau_privada&response=$recaptcha_token");

        // Decodificar la respuesta JSON
        $json = json_decode($respuesta);

        // Comprobar si la validación fue exitosa
        $success = $json->success;

        if (!$success) {
            // Si la validación de reCAPTCHA falla, redirigir con un error
            header('Location: ../index.php?error=Error en el captcha...');
            die();
        } else {
            $recaptcha = true;
        }

        return $recaptcha;
    }

    include_once '../vista/login.php';

    // Mostrar los mensajes
    foreach ($missatges as $missatge) {
        echo '<div class="feedback">' . htmlspecialchars($missatge) . '</div>';
    }
}
