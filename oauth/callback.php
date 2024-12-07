<?php 
require '../database/env.php';

if(isset($_GET['code'])){
    require_once '../oauth/oauth.php';
    $code = $_GET['code'];

    $token_url = 'https://github/login/oauth/access_token';
    $post_data = [
        'client_id' => client_id,
        'client_secret' => client_secret,
        'code' => $code,
        'redirect_uri' => 'https://www.davidromero.cat/oauth/callback.php'
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
    curl_close($ch);

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

        echo 'Hola, ' . htmlspecialchars($user_info['login']) . '!<br>';
        echo 'Nombre: ' . htmlspecialchars($user_info['name']) . '<br>';
        echo 'Correo: ' . htmlspecialchars($user_info['email']) . '<br>';
    } else {
        echo "Error: No s'ha pogut obtenir l'access token";
    }
} else {
    echo "Error: No s'ha pogut obtenir el codi de autorització";
}
?>