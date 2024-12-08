<?php
if(session_start() == PHP_SESSION_NONE){
    session_start();
}
require_once '../oauth/oauth.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $github_login = $_POST['github_login'];

    if($github_login == 'Log in with GitHub'){
        OAuth();
    }

    try{
        require_once __DIR__ . '/database/env.php';
    
        if(isset($_GET['code'])){
            require_once '../oauth/oauth.php';
            $code = $_GET['code'];
        
            $token_url = 'https://github.com/login/oauth/access_token';
            $post_data = [
                'client_id' => client_id,
                'client_secret' => client_secret,
                'code' => $code,
                'redirect_uri' => 'https://www.davidromero.cat/index.php'
            ];
        
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
        
            if ($response === false) {
                // Si hay un error en la solicitud cURL, muestra el mensaje de error
                die('Error en cURL: ' . $curl_error);
            }
        
            echo "Respuesta de GitHub: <pre>" . print_r($response, true) . "</pre>";
        
            $data = json_decode($respuesta, true);
        
            if(isset($data['access_token'])){
                $access_token = $data['access_token'];
        
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
                    afegirUsuariOAuth($connexio, $user_info['login'], $user_info['email'], 'GitHub', $user_info['node_id'], $user_info['avatar_url']);
                    // El nombre de usuario de GitHub
                    $github_username = $user_info['login'];
                    $_SESSION['usuari'] = $github_username;
                    $_SESSION['correu'] = $user_info['email'];
                    $_SESSION['fotoPerfil'] = $user_info['avatar_url'];
                    header('Location: ../index.php');
                    include_once BASE_PATH . 'index.php';
                } else {
                    echo "Error al obtener los datos del usuario.";
                }
            } else {
                echo "Error: No s'ha pogut obtenir l'access token <br>Respuesta de GitHub: " . print_r($data, true);
            }
        } else {
            echo "Error: No s'ha pogut obtenir el codi de autorització";
        }
    } catch (Exception $e){
        echo $e->getMessage();
    }
}
?>