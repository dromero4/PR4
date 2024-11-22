<?php
include_once 'controlador-resetingPassword.php';

    if (!empty($usuari) && !empty($contrassenya)) {
        if (verificarCompte($usuari, $contrassenya, $connexio)) {
            session_start();
            
            //Estableix el tems d'expiracio de la sessio a 40 minuts
            $timeout_duration = 40 * 60;

            // Verifica si hi ha alguna sessió activa.
            if (isset($_SESSION['LAST_ACTIVITY'])) {
                //Calcula el temps transcurrit des de l'ultima activitat
                $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];

                //Si ha passat més temps del limit que hem establert, et fa fora de la sessió
                if ($elapsed_time > $timeout_duration) {
                    session_unset(); //"Allibera" les variables utilitzades
                    session_destroy();   //Destrueix la sessio
                    header("Location: ../vista/login.php"); //Un cop destruïda, l'usuari s'enva a la pagina del login
                    exit;
                }
            }

            // Ultima activitat
            $_SESSION['LAST_ACTIVITY'] = time();

            //Variables de l'usuari
            $_SESSION['usuari'] = $usuari;
            $resultatCorreu = seleccionarCorreu($usuari, $connexio);
            $_SESSION['correu'] = $resultatCorreu['correu'];

            //En cas d'estar logat, s'enva directament a la pagina de consultar articles.
            if (isset($_SESSION['usuari'])) {
                header('Location:../index.php');
            }
        } else {
            //En cas de no ser correcte la contrassenya
            include_once '../vista/login.php';
            $missatges[] = "<br>Contrassenya incorrecte";
        }
    } else {
        //En cas de no haver omplert els camps
        include_once '../vista/login.php';
        $missatges[] = "<br>Has d'introduïr les dades";
    }




//Mostra els missatges
foreach ($missatges as $missatge) {
    include_once '../vista/navbar.view.php';
    echo $missatge;
    }
    
?>