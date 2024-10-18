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



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    switch ($crudSubmit){
        case 'Insertar':
            if(verificarInsertar($model, $nom, $preu) == true){
                echo "Aquest producte ja existeix";
            } else {
                include_once '../vista/insertar.php';
                if(!isEmpty($model, $nom, $preu)){
                    insertar($model, $nom, $preu);
                }
            }
            break;
        case 'Modificar':
            if($id){
                if(verificarID($id)){
                    modificar($model, $nom, $preu, $id);
                } else {
                    include '../vista/modificar.php';
                    echo "No s'ha trobat l'ID $id";
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
    
    switch ($login){
        case 'Log In':
            if(!empty($usuari) && !empty($contrassenya)){
                if(verificarCompte($usuari, $contrassenya)){
                    session_start();
                    echo "Benvingut $usuari";
                } else {
                    echo "usuari no trobat";
                }
            } else {
                include_once '../vista/login.php';
                echo "<br>Has d'introduïr les dades...";
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
                            if(strlen($contrassenya) < 5 && strlen($contrassenya2) < 5){
                                echo "<br>La contrassenya ha de tenir més de 5 caràcters";
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
    
}
?>