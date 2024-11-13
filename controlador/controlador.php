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
            include_once '../vista/insertar.php';
            if(verificarInsertar($model, $nom, $preu) == true){ //Aqui verifiquem si el model que hem inserit ja existeix a la base de dades
                $missatges[] = "Aquest producte ja existeix";
            } else {
                
                if(!isEmpty($model, $nom, $preu)){ //Si no son buits i si no son a la base de dades, afegim l'article.
                    insertar($model, $nom, $preu, $_SESSION['correu']); //Amb el correu de la persona logada que l'hagi inserit
                }
            }

            mostrarMissatges($missatges);
            break;
            //En cas de voler modificar
        case 'Modificar':
            include_once '../vista/modificar.php';
            if($id){
                if(verificarID($id)){ //verifiquem que l'id de l'article que vol verificar no sigui buit
                    if(isset($_SESSION['usuari'])){ //En cas d'estar logat, només deixarà modificar l'article creat per aquest mateix usuari
                        modificar($model, $nom, $preu, $id, getCorreuByID($id));
                    }
                } else {
                    $missatges[] = "No s'ha trobat l'ID $id";
                }
                    
                
            } else {
                $missatges[] = "Has d'inserir l'ID";
            }

            mostrarMissatges($missatges);
            break;        
        case 'Eliminar':
            include_once '../vista/eliminar.php';
            //pel cas d'eliminar
            if($id){ //si l'id no es buit
                if(verificarID($id)){ //verifiquem que l'id existeixi
                    if(eliminar($id)){ //i si existeix, l'elimina
                        $missatges[] = "Eliminat correctament ID: $id";
                    } else {
                        $missatges[] = "No s'ha pogut eliminar...";
                    }
                } else {
                    //En cas de no haver trobat l'id
                    $missatges[] = "No s'ha trobat l'ID $id";
                }
            }

            mostrarMissatges($missatges);
            break;
    }   
    
    //A l'hora de reiniciar password
    if($reiniciarPassword == 'Enviar'){
        include_once 'controlador-reiniciarPassword.php';
    }

    if($forgotPassword == 'Enviar correu'){
        include_once 'controlador-forgotPassword.php';
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

function mostrarMissatges($missatges){
    foreach ($missatges as $missatge) { 
        echo $missatge . "\n"; 
    }
}
?>