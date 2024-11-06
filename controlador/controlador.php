<?php
//DAVID ROMERO
include '../model/model.php'; //Crida al fitxer model per poder accedir a les funcions del mateix.
$crudSubmit = $_POST['Enviar'] ?? null; //Funcio per seleccionar depenent del que hagi triat l'usuari (ediar, inserir...)

//Variables dels articles
$id = $_POST['id'] ?? null;
$model = $_POST['model'] ?? null; 
$nom = $_POST['nom'] ?? null;
$preu = $_POST['preu'] ?? null;

//variable del login
$login = $_POST['login'] ?? null;

//Variables dels usuaris
$correu = $_POST['correu'] ?? null;
$usuari = $_POST['usuari'] ?? null;
$contrassenya = $_POST['contrassenya'] ?? null;
$contrassenya2 = $_POST['contrassenya2'] ?? null; //Variable per verificar la contrassenya al signup

$reiniciarPassword = $_POST['reiniciarPassword'] ?? null; //En cas de voler canviar la contrassenya, aquesta variable s'inicialitza
$contrassenyaCanviar = $_POST['contrassenyaCanviar'] ?? null; //Variable per la nova contrassenya en cas de voler canviar-la

$forgotPassword = $_POST['forgotPassword'] ?? null; //En cas d'haver oblidat el password
$contrassenyaReiniciada = $_POST['contrassenyaReiniciada'] ?? null; //Link contrassenya despres del correu
$missatges = []; //Gestió de missatges / errors.

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    switch ($login){
        case 'Log In':
            //Si l'usuari i la contrassenya no son buits
            include_once 'controlador-login.php';
            break;
            //Per registrar-se
        case 'Sign Up':
            include_once 'controlador-signup.php';
            break;
    }

    //A l'hora de l'usuari (un cop logat) vol fer qualsevol cosa, aqui la controlem.
    switch ($crudSubmit){
        case 'Insertar': //En cas d'insertar
            if(verificarInsertar($model, $nom, $preu) == true){ //Aqui verifiquem si el model que hem inserit ja existeix a la base de dades
                echo "Aquest producte ja existeix";
            } else {
                include_once '../vista/insertar.php';
                if(!isEmpty($model, $nom, $preu)){ //Si no son buits i si no son a la base de dades, afegim l'article.
                    insertar($model, $nom, $preu, $_SESSION['correu']); //Amb el correu de la persona logada que l'hagi inserit
                }
            }
            break;
            //En cas de voler modificar
        case 'Modificar':
            if($id){
                if(verificarID($id)){ //verifiquem que l'id de l'article que vol verificar no sigui buit
                    include '../vista/modificar.php';
                    if(isset($_SESSION['usuari'])){ //En cas d'estar logat, només deixarà modificar l'article creat per aquest mateix usuari
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
            //pel cas d'eliminar
            if($id){ //si l'id no es buit
                if(verificarID($id)){ //verifiquem que l'id existeixi
                    include '../vista/eliminar.php';
                    if(eliminar($id)){ //i si existeix, l'elimina
                        echo "Eliminat correctament ID: $id";
                    } else {
                        echo "No s'ha pogut eliminar...";
                    }
                } else {
                    //En cas de no haver trobat l'id
                    include '../vista/eliminar.php';
                    echo "No s'ha trobat l'ID $id";
                }
            }
            break;
    }   
    
    //A l'hora de reiniciar password
    if($reiniciarPassword == 'Enviar'){
        include '../vista/navbar.view.php';
        include '../vista/reiniciarPassword.php';
        if(!empty($contrassenya)){ //si no s'ha deixada buida la contrassenya
            if(verificarCorreu($correu)){ //verifiquem que el correu existeixi
                if(verificarCompteCorreu($correu, $contrassenya)){ //Aqui verifiquem que el correu coincideixi amb la contrassenya
                    if(verificarContrassenya($contrassenya2)){ //I verifiquem la contrassenya
                        reiniciarPassword($correu, $contrassenya, $contrassenyaCanviar); //En cas de ser tot correcte, reinicia la contrassenya
                    } else {
                        //En cas de no ser correcte, et mostra un missatge de com ha de ser la contrassenya
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

    if($forgotPassword == 'Enviar correu'){
        include_once '../vista/forgotPassword.php';
        if(!empty($correu)){
            if(verificarCorreu($correu)){
                echo enviarMail($correu);
                echo "Verifica el teu correu ($correu), t'hem enviat un ellaç perquè puguis reestablir la teva contrassenya...";
            }
        } else {
            echo "Has d'omplir el correu";
        }
    }
}

//Funcio per verificar si els articles no son buits. 
//Retorna si son buits o no (Bool)
function isEmpty($model, $nom, $preu){
    $empty = false;

    if(empty($model)) {
        $empty = true;
        echo "<br>Has d'inserir el model";
    }
    if(empty($nom)){
        $empty = true;
        echo "<br>Has d'inserir el nom";
    } 
    if(empty($preu)){
        $empty = true;
        echo "<br>Has d'inserir el preu";
    } 

    return $empty;
}
?>