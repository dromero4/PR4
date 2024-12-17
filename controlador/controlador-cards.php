<?php
require_once '../model/model.php';
require_once '../database/env.php';
require_once BASE_PATH . 'database/connexio.php';
include_once '../controlador/controlador.php';

$id = $_POST['id'] ?? null;
$opcio = $_POST['article-button'] ?? null;

switch ($opcio){
    case 'delete':
        if($id){ //si l'id no es buit
            if(eliminar($connexio, $id)){ //i si existeix, l'elimina
                $missatges[] = "Eliminat correctament ID: $id";
            } else {
                $missatges[] = "No s'ha pogut eliminar...";
            }
        }
        header('Location: ../index.php');
        break;
    
    case 'qr':
        echo "To Do";
        break;
}
?>