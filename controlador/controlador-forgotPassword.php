<?php
include_once 'controlador.php';
include_once '../vista/forgotPassword.php';

if(!empty($correu)){
    if(verificarCorreu($correu)){
        enviarMail($correu);
        $missatges[] = "Verifica el teu correu ($correu), t'hem enviat un ellaç perquè puguis reestablir la teva contrassenya...";
    } else {
        $missatges[] = "El correu no existeix";
    }
} else {
    $missatges[] = "Has d'omplir el correu";
}

mostrarMissatges($missatges);
?>