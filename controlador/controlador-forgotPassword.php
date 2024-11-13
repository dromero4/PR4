<?php
include_once '../vista/forgotPassword.php';
if(!empty($correu)){
    if(verificarCorreu($correu)){
        echo enviarMail($correu);
        echo "Verifica el teu correu ($correu), t'hem enviat un ellaç perquè puguis reestablir la teva contrassenya...";
    }
} else {
    echo "Has d'omplir el correu";
}
?>