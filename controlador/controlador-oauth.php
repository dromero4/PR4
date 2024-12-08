<?php
session_start();  // Inicia la sesión al principio del archivo

require_once '../oauth/oauth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $github_login = $_POST['github_login'];

    if ($github_login == 'Log in with GitHub') {
        OAuth();  // Aquí inicias el proceso de OAuth
    }
}

try {
    require_once __DIR__ . '/database/env.php';

    if (isset($_GET['code'])) {  // Si se recibe el código de autorización
        require_once '../oauth/oauth.php';
        $code = $_GET['code'];

        // Define la URL para obtener el token de acceso
        $token_url = 'https://github.com/login/oauth/access_token';
        $post_data = [
            'client_id' => client_id,
            'client_secret' => client_secret,
            'code' => $code,
            'redirect_uri' => 'https://www.davidromero.cat/index.php'  // Asegúrate de que esta URL sea la correcta
        ];

        // Realiza la solicitud cURL para obtener el token
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $token_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json'
        ]);

        $respuesta = curl_exec($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($respuesta === false) {
            die('Error en cURL: ' . $curl_error);  // Maneja el error si no se obtiene respuesta
        }

        $data = json_decode($respuesta, true);

        if (isset($data['access_token'])) {
            $access_token = $data['access_token'];

            // Solicita los datos del usuario con el token de acceso
            $user_url = 'https://api.github.com/user';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $user_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: token ' . $access_token,
                'User-Agent: PHP OAuth'
            ]);
            $user_response = curl_exec($ch);
            curl_close($ch);

            $user_info = json_decode($user_response, true);

            if (isset($user_info['login'])) {
                // Guarda los datos del usuario en la sesión
                $_SESSION['usuari'] = $user_info['login'];
                $_SESSION['correu'] = $user_info['email'];
                $_SESSION['fotoPerfil'] = $user_info['avatar_url'];

                // Redirige al usuario a la página principal (o a cualquier página que desees)
                header('Location: index.php');
                exit;  // Detén la ejecución del script después de la redirección
            } else {
                echo "Error al obtener los datos del usuario.";
            }
        } else {
            echo "Error: No se pudo obtener el access token.";
        }
    } else {
        echo "Error: No se pudo obtener el código de autorización.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
