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

$missatges = []; //Gestió de missatges / errors.

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    switch ($login){
        case 'Log In':
            //Si l'usuari i la contrassenya no son buits
            if (!empty($usuari) && !empty($contrassenya)) {
                if (verificarCompte($usuari, $contrassenya)) {
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
                    $resultatCorreu = seleccionarCorreu($usuari);
                    $_SESSION['correu'] = $resultatCorreu['correu'];
        
                    //En cas d'estar logat, s'enva directament a la pagina de consultar articles.
                    if (isset($_SESSION['usuari'])) {
                        header('Location:../vista/consultar.php');
                    }
                } else {
                    //En cas de no ser correcte la contrassenya
                    include '../vista/login.php';
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
            break;
        
            //Per registrar-se
        case 'Sign Up':
            //En cas de ser totes les variables omplertes
            if(!empty($usuari) && !empty($contrassenya) && !empty($correu)){
                //encriptem la contrassenya a hash per així ja tenir la contrassenya encriptada
                $contrassenyaHash = password_hash($contrassenya, PASSWORD_DEFAULT);
                include_once '../vista/signup.php';
                //Verifiquem si el correu es més llarg de 40 caràcters
                if(strlen($correu) > 40){
                    echo "<br>El correu ha de tenir menys de 40 caràcters...";
                } else if (verificarCorreu($correu)){ //Verifiquem si ja existeix el correu
                    echo "<br>El correu ja existeix";
                } else {
                    if(strlen($usuari) > 20){ //verifiquem que no sigui massa llarg el nom d'usuari
                        echo "<br>El nom d'usuari ha de tenir menys de 20 caràcters...";
                    } else if(verificarUsuari($usuari)){ //I verifiquem que no existeixi previament
                        echo "<br>El nom d'usuari ja existeix";
                    } else {
                        if($contrassenya == $contrassenya2){ //Al cas de confirmar la contrassenya
                            if(verificarContrassenya($contrassenya)){ //Verifiquem que la contrassenya compleixi certs valors.
                                echo "<br>La contrassenya ha de tenir:
                                <br>- Al menys 5 caràcters.
                                <br>- Al menys una lletra majuscula.
                                <br>- Al menys una lletra minúscula.
                                <br>- Al menys un numero.
                                <br>- Al menys un caràcter especial.";
                            } else {
                                if(insertarUsuari($correu, $usuari, $contrassenyaHash)){ //En cas de ser tot correcte, inserim l'usuari a la base de dades amb la contrassenya encriptada
                                    echo "<br>Usuari creat correctament<br>";
                                    ?>
                                    <a href="../vista/login.php"><button>Fes login</button></a>
                                    <?php
                                } else {
                                    //En cas d'haver algun error
                                    include_once '../vista/signup.php';
                                    echo "<br>No s'ha pogut crear l'usuari";
                                }
                            }
                        } else {
                            //En cas de no ser les contrassenyes de registre iguals
                            include_once '../vista/signup.php';
                            echo "Les contrassenyes han de ser iguals...";
                        }
                    }
                }                
            } else {
                //En cas de no haver omplert les dades
                include '../vista/signup.php';
                echo "<br>Has d'introduïr les dades...";
            }
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
}
?>