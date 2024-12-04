<?php
session_start();
require_once '../model/model.php';  // Incluye el modelo que maneja las consultas a la base de datos
include_once '../controlador/controlador.php';
require_once '../database/connexio.php';

// Inicializar variable para mensajes
$missatges = [];

// Comprobar si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos enviados por el formulario
    $usuari = $_POST['usuariPerfil'] ?? null;
    $correu = $_POST['correuPerfil'] ?? null;
    $fotoPerfil = $_POST['imagen'] ?? null;

    // Verificar que el usuario y correo son válidos
    if ($usuari && $correu) {
        // Intentar actualizar el usuario
        if(verificarUsuari($usuari, $connexio)){
            if(verificarCorreu($correu, $connexio)){
                if(verificarImatge($fotoPerfil)){
                    if (actualitzarUsuari($connexio, $usuari, $correu, $_SESSION['correu'], $fotoPerfil)) {
                        // Actualizar datos en la sesión
                        $_SESSION['usuari'] = $usuari;
                        $_SESSION['correu'] = $correu;
                        $_SESSION['fotoPerfil'] = $fotoPerfil;
            
                        // Si la cookie existe, actualizarla también
                        if (isset($_COOKIE['cookie_user'])) {
                            setcookie('cookie_user', $usuari, time() + (86400 * 30 * 30 * 24), "/");  // 30 días de validez
                        }
            
                        // Mensaje de éxito
                        $missatges[] = "S'ha actualitzat correctament!";
                    } else {
                        // Mensaje de error si no se pudo actualizar
                        $missatges[] = "No s'ha pogut actualitzar el perfil.";
                    }
                } else {
                    $missatges[] = "La imatge no és vàlida.";
                }
            } else {
                $missatges[] = 'El correo electrónico ya existe en el sistema';
            }
        } else {
            $missatges[] = 'El usuari ya existe';
        }
        
    } else {
        // Si faltan datos
        $missatges[] = "Datos inválidos o incompletos.";
    }

    // Mostrar los mensajes
    mostrarMissatges($missatges);
    
    // Redirigir a la página de perfil después de procesar el formulario
    // header("Location: ../vista/profile.php");
    exit;  // Asegúrate de que el script se detenga aquí después de la redirección
}

function verificarImatge($imatge){
    if(!filter_var($imatge, FILTER_VALIDATE_URL)){
        return false;
    } else {
        return true;
    }
}

