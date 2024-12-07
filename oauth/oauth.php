<?php 
function OAuth(){
    require '../database/env.php';

    $callbackURL = 'https://www.davidromero.cat/oauth/callback.php'; //URL del callback que despues configuraremos

    //URL que usamos para "hablar" con github.
    $URL = 'https://github.com/login/oauth/authorize?client_id=' . client_id . '&redirect_uri=' . $callbackURL . '&scope=user:email';
    header('Location:' . $URL);
}
?>