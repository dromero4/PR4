<?php
include '../model/model.php';
$crudSubmit = $_POST['Enviar'] ?? null;

$id = $_POST['id'] ?? null;
$model = $_POST['model'] ?? null;
$nom = $_POST['nom'] ?? null;
$preu = $_POST['preu'] ?? null;

$login = $_POST['login'] ?? null;

$correu = $_POST['correu'] ?? null;
$usuari = $_POST['usuari'] ?? null;
$contrassenya = $_POST['contrassenya'] ?? null;
$contrassenya2 = $_POST['contrassenya2'] ?? null;

$reiniciarPassword = $_POST['reiniciarPassword'] ?? null;
$contrassenyaCanviar = $_POST['contrassenyaCanviar'] ?? null;

$missatges = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    switch ($login){
        case 'Log In':
            if (!empty($usuari) && !empty($contrassenya)) {
                if (verificarCompte($usuari, $contrassenya)) {
                    session_start();
                    
                    // Establece el tiempo de expiración de la sesión en 40 minutos
                    $timeout_duration = 40 * 60; // 40 minutos en segundos
        
                    // Verifica si la sesión ha sido iniciada
                    if (isset($_SESSION['LAST_ACTIVITY'])) {
                        // Calcula el tiempo transcurrido desde la última actividad
                        $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
        
                        // Si ha pasado más tiempo que el límite establecido, destruye la sesión
                        if ($elapsed_time > $timeout_duration) {
                            session_unset();     // Libera todas las variables de sesión
                            session_destroy();   // Destruye la sesión
                            header("Location: ../vista/login.php"); // Redirige al usuario a la página de login
                            exit;
                        }
                    }
        
                    // Actualiza la última actividad
                    $_SESSION['LAST_ACTIVITY'] = time();
        
                    $_SESSION['usuari'] = $usuari;
                    $resultatCorreu = seleccionarCorreu($usuari);
                    $_SESSION['correu'] = $resultatCorreu['correu'];
        
                    if (isset($_SESSION['usuari'])) {
                        header('Location:../vista/consultar.php');
                    }
                } else {
                    include '../vista/login.php';
                    $missatges[] = "<br>Contrassenya incorrecte";
                }
            } else {
                include_once '../vista/login.php';
                $missatges[] = "<br>Has d'introduïr les dades";
            }
        
            foreach ($missatges as $missatge) {
                include_once '../vista/navbar.view.php';
                echo $missatge;
            }
            break;
        
        case 'Sign Up':
            if(!empty($usuari) && !empty($contrassenya) && !empty($correu)){
                $contrassenyaHash = password_hash($contrassenya, PASSWORD_DEFAULT);
                include_once '../vista/signup.php';
                if(strlen($correu) > 40){
                    echo "<br>El correu ha de tenir menys de 40 caràcters...";
                } else if (verificarCorreu($correu)){
                    echo "<br>El correu ja existeix";
                } else {
                    if(strlen($usuari) > 20){
                        echo "<br>El nom d'usuari ha de tenir menys de 20 caràcters...";
                    } else if(verificarUsuari($usuari)){
                        echo "<br>El nom d'usuari ja existeix";
                    } else {
                        if($contrassenya == $contrassenya2){
                            if(verificarContrassenya($contrassenya)){
                                echo "<br>La contrassenya ha de tenir:
                                <br>- Al menys 5 caràcters.
                                <br>- Al menys una lletra majuscula.
                                <br>- Al menys una lletra minúscula.
                                <br>- Al menys un numero.
                                <br>- Al menys un caràcter especial.";
                            } else {
                                if(insertarUsuari($correu, $usuari, $contrassenyaHash)){
                                    echo "<br>Usuari creat correctament<br>";
                                    ?>
                                    <a href="../vista/login.php"><button>Fes login</button></a>
                                    <?php
                                } else {
                                    include_once '../vista/signup.php';
                                    echo "<br>No s'ha pogut crear l'usuari";
                                }
                            }
                        } else {
                            include_once '../vista/signup.php';
                            echo "Les contrassenyes han de ser iguals...";
                        }
                    }
                }                
            } else {
                include '../vista/signup.php';
                echo "<br>Has d'introduïr les dades...";
            }
            break;
    }

    switch ($crudSubmit){
        case 'Insertar':
            if(verificarInsertar($model, $nom, $preu) == true){
                echo "Aquest producte ja existeix";
            } else {
                include_once '../vista/insertar.php';
                if(!isEmpty($model, $nom, $preu)){
                    insertar($model, $nom, $preu, $_SESSION['correu']);
                }
            }
            break;
        case 'Modificar':
            if($id){
                if(verificarID($id)){
                    include '../vista/modificar.php';
                    if(isset($_SESSION['usuari'])){
                        modificar($model, $nom, $preu, $id, $_SESSION['correu']);
                    } else {
                        include '../vista/modificar.php';
                        echo "No s'ha trobat l'ID $id";
                    }
                    }
                    
                
            } else {
                include '../vista/modificar.php';
                echo "Has d'inserir l'ID";
            }
            break;        
        case 'Eliminar':
            if($id){
                if(verificarID($id)){
                    include '../vista/eliminar.php';
                    if(eliminar($id)){
                        echo "Eliminat correctament ID: $id";
                    } else {
                        echo "No s'ha pogut eliminar...";
                    }
                } else {
                    include '../vista/eliminar.php';
                    echo "No s'ha trobat l'ID $id";
                }
            }
            break;
    }   
    
    if($reiniciarPassword == 'reiniciarPassword'){
        include '../vista/navbar.view.php';
        include '../vista/reiniciarPassword.php';
        if(!empty($contrassenya)){
            if(verificarCorreu($correu)){
                if(verificarCompteCorreu($correu, $contrassenya)){
                    if(verificarContrassenya($contrassenya2)){
                        reiniciarPassword($correu, $contrassenya, $contrassenyaCanviar);
                    } else {
                        echo "<br>La contrassenya ha de tenir:
                        <br>- Al menys 5 caràcters.
                        <br>- Al menys una lletra majuscula.
                        <br>- Al menys una lletra minúscula.
                        <br>- Al menys un numero.
                        <br>- Al menys un caràcter especial.";
                    }
                } else {
                    echo "<br>Contrassenya incorrecte...";
                }
            } else {
                echo "<br>No s'ha trobat el compte...";
            }
        } else {
            echo "Has d'omplir la contrassenya...";
        }
    }
}
?>