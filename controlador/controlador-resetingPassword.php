<?php
require_once '../model/model.php';
include_once 'controlador.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['token'])) {
        $correu = $_POST['email'];
        $token = $_POST['token'];
        $new_contrassenya = $_POST['contrassenyaReiniciada1'];

        if(verificarToken($token, $correu)){
            if(updatePassword($correu, $new_contrassenya)){
                $missatges[] = "Contrassenya canviada correctament.";
            } else {
                $missatges[] = "La contrassenya no s'ha pogut recuperar...";
            }
        } else {
            $missatges[] = "Token no vàlid";
        }

        
        mostrarMissatges($missatges);
        
    }
}
?>
