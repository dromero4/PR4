<?php
//DAVID ROMERO

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

//Funcio per insertar l'article a la base de dades. També mostra l'ID.
function insertar($model, $nom, $preu, $correu){
    require '../connexio.php';
    $insertarArticle = $connexio->prepare("INSERT INTO articles (model, nom, preu, correu) VALUES(:model, :nom, :preu, :correu)");
    $insertarArticle->bindParam(":model", $model);
    $insertarArticle->bindParam(":nom", $nom);
    $insertarArticle->bindParam(":preu", $preu);
    $insertarArticle->bindParam(":correu", $correu);
    $insertarArticle->execute();

    $ultimID = $connexio->lastInsertId();
    echo "Inserit correctament! ID: $ultimID";
}

//Verifica si l'article que vols inserir no existeixi a la base de dades
function verificarInsertar($model, $nom, $preu){
    $verificar = false;
    require '../connexio.php';
    $verificarInsertar = $connexio->prepare("SELECT * FROM articles WHERE model = :model AND nom = :nom AND preu = :preu");
    $verificarInsertar->bindParam(":model", $model);
    $verificarInsertar->bindParam(":nom", $nom);
    $verificarInsertar->bindParam(":preu", $preu);
    $verificarInsertar->execute();

    if($verificarInsertar->rowCount() != 0){
        $verificar = true;
    }

    return $verificar;
}

//Funcio per modificar un article (en cas de ser el seu)
function modificar($model, $nom, $preu, $id, $correu){
    require '../connexio.php';
    if(!empty($model) && !empty($nom) && !empty($preu)){
        $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, nom = :nom, preu = :preu WHERE id = $id AND correu = :correu");
        $modificarDades->bindParam(':model', $model);
        $modificarDades->bindParam(':correu', $correu);
        $modificarDades->bindParam(':nom', $nom);
        $modificarDades->bindParam(':preu', $preu);
        $modificarDades->execute();

        if($correu == $_SESSION['correu']){
            //En cas de no tenir el mateix correu que l'article, no et deixa modificar.
            echo "No pots modificar aquest article perquè no ets el seu propietari";
        } else {
            include_once '../vista/modificar.php';
            echo "<br>Article amb ID: $id editat correctament";
            
            
        }
        
        //Aqui son comprobacions varies en funcio del que estigui omplert o no, ja que a l'hora de modificar, no has de modificar tot si no vols.
    } else if(!empty($model) && !empty($nom) && empty($preu)){
        $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, nom = :nom WHERE id = $id AND correu = :correu");
        $modificarDades->bindParam(':model', $model);
        $modificarDades->bindParam(':correu', $correu);
        $modificarDades->bindParam(':nom', $nom);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    } else if(!empty($model) && !empty($preu) && empty($nom)){
        $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, preu = :preu WHERE id = $id AND correu = :correu");
        $modificarDades->bindParam(':model', $model);
        $modificarDades->bindParam(':correu', $correu);
        $modificarDades->bindParam(':preu', $preu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }  else if(!empty($nom) && !empty($preu) && empty($model)){
        $modificarDades = $connexio->prepare("UPDATE articles SET nom = :nom, preu = :preu WHERE id = $id AND correu = :correu");
        $modificarDades->bindParam(':nom', $nom);
        $modificarDades->bindParam(':correu', $correu);
        $modificarDades->bindParam(':preu', $preu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }  else if(!empty($nom) && empty($preu) && empty($model)){
        $modificarDades = $connexio->prepare("UPDATE articles SET nom = :nom WHERE id = $id AND correu = :correu");
        $modificarDades->bindParam(':nom', $nom);
        $modificarDades->bindParam(':correu', $correu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }  else if(!empty($preu) && empty($nom) && empty($model)){
        $modificarDades = $connexio->prepare("UPDATE articles SET preu = :preu WHERE id = $id AND correu = :correu");

        $modificarDades->bindParam(':preu', $preu);
        $modificarDades->bindParam(':correu', $correu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }  else if(!empty($model) && empty($nom) && empty($preu)){
        $modificarDades = $connexio->prepare("UPDATE articles SET model = :model WHERE id = $id AND correu = :correu");

        $modificarDades->bindParam(':model', $model);
        $modificarDades->bindParam(':correu', $correu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }else {
        include_once '../vista/modificar.php';
        echo "<br>No s'ha modificat cap dada";
    }
    
}

//Funcio per eliminar l'ID
function eliminar($id){

    require '../connexio.php';
    $eliminar = $connexio->prepare("DELETE FROM articles WHERE id = :id");
    $eliminar->bindParam(":id", $id);
    $eliminar->execute();

    if($eliminar){
        return true;
    }
}

//Funcio per verificar previament si existeix l'ID a la base de dades
function verificarID($id){
    require '../connexio.php';

    $verificar = $connexio->prepare("SELECT * FROM articles WHERE id = :id");
    $verificar->bindParam(":id", $id);
    $verificar->execute();

    if($verificar->rowCount() == 0){
        return false;
    } else {
        return true;
    }
}

//Funcio per insertar usuari
function insertarUsuari($correu, $usuari, $contrassenyaHash){
    try{
        require '../connexio.php';
        $insertarUsuari = $connexio->prepare("INSERT INTO usuaris(correu, usuari, contrassenya) VALUES(:correu, :usuari, :contrassenya)");
        $insertarUsuari->bindParam(":correu", $correu);
        $insertarUsuari->bindParam(":usuari", $usuari);
        $insertarUsuari->bindParam(":contrassenya", $contrassenyaHash);
        $insertarUsuari->execute();
        if($insertarUsuari){
            return true;
        }
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    
}

//Funcio per verificar si el correu existeix a l'hora de registrar-se
function verificarCorreu($correu){
    require '../connexio.php';
    $verificarCorreu = $connexio->prepare("SELECT * FROM usuaris WHERE correu = :correu");
    $verificarCorreu->bindParam(":correu", $correu);
    $verificarCorreu->execute();

    if($verificarCorreu->rowCount() > 0){
        return true;
    }
}

//Funcio per verificar si l'usuari existeix a l'hora de registarr-se
function verificarUsuari($usuari){
    require '../connexio.php';
    $verificarUsuari = $connexio->prepare("SELECT * FROM usuaris WHERE usuari = :usuari");
    $verificarUsuari->bindParam(":usuari", $usuari);
    $verificarUsuari->execute();

    if($verificarUsuari->rowCount() > 0){
        return true;
    }
}

//Funcio per verificar si la contrassenya i l'usuari coincideix a l'hora de logar-se
function verificarCompte($usuari, $contrassenya){
    require '../connexio.php';

    $verificarContrassenya = $connexio->prepare("SELECT contrassenya FROM usuaris WHERE usuari = :usuari");
    $verificarContrassenya->bindParam(":usuari", $usuari);
    $verificarContrassenya->execute();

    //Agafem la contrassenya
    $resultat = $verificarContrassenya->fetch(PDO::FETCH_ASSOC);

    if($resultat){
        //i la guardem a una variable per poder verificar-la
        $hash = $resultat['contrassenya'];

        //Funcio interna del php per poder verificar una contrassenya que sigui encriptada
        //password_verify NOMES FUNCIONA AMB password_hash();
        if(password_verify($contrassenya, $hash)){
            return true;
        } else {
            return false;
        }
    }
    
}

//Funcio per veure si el correu coincideix amb la contrassenya
function verificarCompteCorreu($correu, $contrassenya){
    require '../connexio.php';

    $verificarContrassenya = $connexio->prepare("SELECT contrassenya FROM usuaris WHERE correu = :correu");
    $verificarContrassenya->bindParam(":correu", $correu);
    $verificarContrassenya->execute();

    $resultat = $verificarContrassenya->fetch(PDO::FETCH_ASSOC);

    if($resultat){
        $hash = $resultat['contrassenya'];

        //Funcio interna del php per poder verificar una contrassenya que sigui encriptada
        //password_verify NOMES FUNCIONA AMB password_hash();
        if(password_verify($contrassenya, $hash)){
            return true;
        } else {
            return false;
        }
    }
    
}

//Funcio per seleccionar el correu en questió de l'usuari que estigui logat
function seleccionarCorreu($usuari){
    require '../connexio.php';

    if(verificarUsuari($usuari)){
        $correo = $connexio->prepare("SELECT correu FROM usuaris WHERE usuari = :usuari");
        $correo->bindParam(":usuari", $usuari);
        $correo->execute();
        
        $resultat = $correo->fetch(PDO::FETCH_ASSOC);
        
        return $resultat;
    } else {
        echo "Hi ha hagut un problema";
    }
}

//Funcio per reiniciar el password
//Parametres: 
// correu: correu de l'usuari que vols canviar la contrassenya
// contrassenya: contrassenya actual de l'usuari que hem posat
// contrassenyaCanviar: nova contrassenya
function reiniciarPassword($correu, $contrassenya, $contrassenyaCanviar){
    require '../connexio.php';
    $reiniciarPassword = $connexio->prepare("SELECT contrassenya FROM usuaris WHERE correu = :correu");
    $reiniciarPassword->bindParam(":correu", $correu);
    $reiniciarPassword->execute();

    $pswd = $reiniciarPassword->fetch(PDO::FETCH_ASSOC);

    $contrassenyaHash = password_hash($contrassenyaCanviar, PASSWORD_DEFAULT);
    if(password_verify($contrassenya, $pswd['contrassenya'])){
        $canviarContrassenya = $connexio->prepare("UPDATE usuaris SET contrassenya = :nuevaContrassenya WHERE correu = :correu");
        $canviarContrassenya->bindParam(":nuevaContrassenya", $contrassenyaHash);
        $canviarContrassenya->bindParam(":correu", $correu);
        
        if($canviarContrassenya->execute()){
            echo "La contrassenya s'ha canviat correctament";
        } else {
            echo "Hi ha hagut un problema";
        }
        

    } else {
        echo "No es correcte!";
    }
}

//Aqui verifiquem que la contrassenya cumpleixi diversos valors.
function verificarContrassenya($contrassenya2){
    $resultat = false;
    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/", $contrassenya2)){
        $resultat = true;
    }


    return $resultat;
}
?>