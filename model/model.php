<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//DAVID ROMERO
//Funcio per insertar l'article a la base de dades. També mostra l'ID.
function insertar($model, $nom, $preu, $correu, $connexio){
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
function verificarInsertar($model, $nom, $preu, $connexio){
    $verificar = false;
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
function modificar($model, $nom, $preu, $id, $correu, $connexio){
    if(!empty($model) && !empty($nom) && !empty($preu)){
        if($correu != $_SESSION['correu']){
            //En cas de no tenir el mateix correu que l'article, no et deixa modificar.
            echo "No pots modificar aquest article perquè no ets el seu propietari";
        } else {
            $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, nom = :nom, preu = :preu WHERE id = $id AND correu = :correu");
            $modificarDades->bindParam(':model', $model);
            $modificarDades->bindParam(':correu', $correu);
            $modificarDades->bindParam(':nom', $nom);
            $modificarDades->bindParam(':preu', $preu);
            $modificarDades->execute();
            include_once '../vista/modificar.php';
            echo "<br>Article amb ID: $id editat correctament";
        }
        
        //Aqui son comprobacions varies en funcio del que estigui omplert o no, ja que a l'hora de modificar, no has de modificar tot si no vols.
    } else if(!empty($model) && !empty($nom) && empty($preu)){
        if($correu != $_SESSION['correu']){
            //En cas de no tenir el mateix correu que l'article, no et deixa modificar.
            echo "No pots modificar aquest article perquè no ets el seu propietari";
        } else {
            $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, nom = :nom WHERE id = $id AND correu = :correu");
            $modificarDades->bindParam(':model', $model);
            $modificarDades->bindParam(':correu', $correu);
            $modificarDades->bindParam(':nom', $nom);
            $modificarDades->execute();
            include_once '../vista/modificar.php';
            echo "<br>Article amb ID: $id editat correctament";
        }
        
    } else if(!empty($model) && !empty($preu) && empty($nom)){
        if($correu != $_SESSION['correu']){
            //En cas de no tenir el mateix correu que l'article, no et deixa modificar.
            echo "No pots modificar aquest article perquè no ets el seu propietari";
        } else {
            $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, preu = :preu WHERE id = $id AND correu = :correu");
            $modificarDades->bindParam(':model', $model);
            $modificarDades->bindParam(':correu', $correu);
            $modificarDades->bindParam(':preu', $preu);
            $modificarDades->execute();
            include_once '../vista/modificar.php';
            echo "<br>Article amb ID: $id editat correctament";
        }
        
    }  else if(!empty($nom) && !empty($preu) && empty($model)){
        if($correu != $_SESSION['correu']){
            //En cas de no tenir el mateix correu que l'article, no et deixa modificar.
            echo "No pots modificar aquest article perquè no ets el seu propietari";
        } else {
            $modificarDades = $connexio->prepare("UPDATE articles SET nom = :nom, preu = :preu WHERE id = $id AND correu = :correu");
            $modificarDades->bindParam(':nom', $nom);
            $modificarDades->bindParam(':correu', $correu);
            $modificarDades->bindParam(':preu', $preu);
            $modificarDades->execute();
            include_once '../vista/modificar.php';
            echo "<br>Article amb ID: $id editat correctament";
        }
        
    }  else if(!empty($nom) && empty($preu) && empty($model)){
        if($correu != $_SESSION['correu']){
            //En cas de no tenir el mateix correu que l'article, no et deixa modificar.
            echo "No pots modificar aquest article perquè no ets el seu propietari";
        } else {
            $modificarDades = $connexio->prepare("UPDATE articles SET nom = :nom WHERE id = $id AND correu = :correu");
            $modificarDades->bindParam(':nom', $nom);
            $modificarDades->bindParam(':correu', $correu);
            $modificarDades->execute();
            include_once '../vista/modificar.php';
            echo "<br>Article amb ID: $id editat correctament";
        }
        
    }  else if(!empty($preu) && empty($nom) && empty($model)){
        if($correu != $_SESSION['correu']){
            //En cas de no tenir el mateix correu que l'article, no et deixa modificar.
            echo "No pots modificar aquest article perquè no ets el seu propietari";
        } else {
            $modificarDades = $connexio->prepare("UPDATE articles SET preu = :preu WHERE id = $id AND correu = :correu");
            $modificarDades->bindParam(':preu', $preu);
            $modificarDades->bindParam(':correu', $correu);
            $modificarDades->execute();
            include_once '../vista/modificar.php';
            echo "<br>Article amb ID: $id editat correctament";
        }
        
    }  else if(!empty($model) && empty($nom) && empty($preu)){
        if($correu != $_SESSION['correu']){
            //En cas de no tenir el mateix correu que l'article, no et deixa modificar.
            echo "No pots modificar aquest article perquè no ets el seu propietari";
        } else {
            $modificarDades = $connexio->prepare("UPDATE articles SET model = :model WHERE id = $id AND correu = :correu");
            $modificarDades->bindParam(':model', $model);
            $modificarDades->bindParam(':correu', $correu);
            $modificarDades->execute();
            include_once '../vista/modificar.php';
            echo "<br>Article amb ID: $id editat correctament";
        }
    }else {
        include_once '../vista/modificar.php';
        echo "<br>No s'ha modificat cap dada";
    }
    
}

//Funcio per eliminar l'ID
function eliminar($id, $connexio){
    $eliminar = $connexio->prepare("DELETE FROM articles WHERE id = :id");
    $eliminar->bindParam(":id", $id);
    $eliminar->execute();

    if($eliminar){
        return true;
    }
}

//Funcio per verificar previament si existeix l'ID a la base de dades
function verificarID($id, $connexio){

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
function insertarUsuari($correu, $usuari, $contrassenyaHash, $connexio){
    try{
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
function verificarCorreu($correu, $connexio){
    $verificarCorreu = $connexio->prepare("SELECT * FROM usuaris WHERE correu = :correu");
    $verificarCorreu->bindParam(":correu", $correu);
    $verificarCorreu->execute();

    if($verificarCorreu->rowCount() > 0){
        return true;
    }
}

//Funcio per verificar si l'usuari existeix a l'hora de registarr-se
function verificarUsuari($usuari, $connexio){
    $verificarUsuari = $connexio->prepare("SELECT * FROM usuaris WHERE usuari = :usuari");
    $verificarUsuari->bindParam(":usuari", $usuari);
    $verificarUsuari->execute();

    if($verificarUsuari->rowCount() > 0){
        return true;
    }
}

//Funcio per verificar si la contrassenya i l'usuari coincideix a l'hora de logar-se
function verificarCompte($usuari, $contrassenya, $connexio){

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
function verificarCompteCorreu($correu, $contrassenya, $connexio){

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
function seleccionarCorreu($usuari, $connexio){

    if(verificarUsuari($usuari, $connexio)){
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
function reiniciarPassword($correu, $contrassenya, $contrassenyaCanviar, $connexio){
    try{
        $reiniciarPassword = $connexio->prepare("SELECT contrassenya FROM usuaris WHERE correu = :correu");
        $reiniciarPassword->bindParam(":correu", $correu);
        $reiniciarPassword->execute();
    
    
        $pswd = $reiniciarPassword->fetch(PDO::FETCH_ASSOC);
    
        if($pswd){
            if(password_verify($contrassenya, $pswd['contrassenya'])){
                $contrassenyaHash = password_hash($contrassenyaCanviar, PASSWORD_DEFAULT);
                $canviarContrassenya = $connexio->prepare("UPDATE usuaris SET contrassenya = :nuevaContrassenya WHERE correu = :correu");
                $canviarContrassenya->bindParam(":nuevaContrassenya", $contrassenyaHash);
                $canviarContrassenya->bindParam(":correu", $correu);
                $canviarContrassenya->execute();
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (Error $e){
        return $e;
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

function enviarMail($correu, $connexio){
    require_once '../lib/PHPMailer/src/Exception.php';
    require_once '../lib/PHPMailer/src/PHPMailer.php';
    require_once '../lib/PHPMailer/src/SMTP.php';
    
    $token = bin2hex(random_bytes(16));
    $token_expires = date('Y-m-d H:i:s', time() + 60 * 30);

    $insertarTokenBaseDades = $connexio->prepare("UPDATE usuaris SET token = :token, token_expires = :token_expires WHERE correu = :correu");
    $insertarTokenBaseDades->bindParam(":token", $token);
    $insertarTokenBaseDades->bindParam(":token_expires", $token_expires);
    $insertarTokenBaseDades->bindParam(":correu", $correu);
    
    if($insertarTokenBaseDades->execute()){
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'd.romero@sapalomera.cat';
            $mail->Password = 'ndrfaxgrenbsyczy';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
        
            // Configuración del correo
            $mail->setFrom('d.romero@sapalomera.cat', 'admin');
            $mail->addAddress($correu); // Destinatario
        
            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de password';
            $mail->Body = "Haz click en este enlace para reiniciar la contraseña: 
            <a href='http://www.davidromero.cat/PR4-NEW/vista/resetingPassword.php?token=" . urlencode($token) . "&email=" . urlencode($correu) . "'>Restablecer Contraseña</a>";


            if(!$mail->send()){
                throw new Error("Hi ha hagut un problema...");
            }
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
}

function getCorreuByID($id, $connexio){
    $getCorreuByID = $connexio->prepare("SELECT correu FROM articles WHERE id = :id");
    $getCorreuByID->bindParam(":id", $id);
    if($getCorreuByID->execute()){
        $correu = $getCorreuByID->fetch(PDO::FETCH_ASSOC);
        return $correu['correu'];
    }
}

// function getNamebyCorreu($correu, $connexio){

//     $getNameByCorreu = $connexio->prepare("SELECT usuari FROM usuaris WHERE correu = :correu");
//     $getNameByCorreu->bindParam(":correu", $correu);
//     $getNameByCorreu->execute();

//     $usuari = $getNameByCorreu->fetch(PDO::FETCH_ASSOC);

//     if($getNameByCorreu->execute()){
//         return $usuari['usuari'];

//     } else {
//         echo "Hi ha hagut un problema...";
//     }
// }

function verificarToken($token, $correu, $connexio){

    $verificarToken = $connexio->prepare("SELECT token, token_expires FROM usuaris WHERE correu = :correu");
    $verificarToken->bindParam(":correu", $correu);
    $verificarToken->execute();

    if($verificarToken->rowCount() > 0){
        $resultat = $verificarToken->fetch(PDO::FETCH_ASSOC);

        if($resultat['token'] === $token){
            $expiracioToken = New DateTime($resultat['token_expires']);
            $dataActual = new DateTime();

            if($expiracioToken > $dataActual){
                return false; //Token caducat
            } else {
                return true;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function updatePassword($correu, $new_password, $connexio){

    $getPassword = $connexio->prepare("SELECT contrassenya FROM usuaris WHERE correu = :correu");
    $getPassword->bindParam(":correu", $correu);
    $getPassword->execute();

    $resultat = $getPassword->fetch(PDO::FETCH_ASSOC);

    if($resultat){
        $contrassenya = password_hash($new_password, PASSWORD_DEFAULT);
        
        $updatePassword = $connexio->prepare("UPDATE usuaris SET contrassenya = :contrassenya WHERE correu = :correu");
        $updatePassword->bindParam(":contrassenya", $contrassenya);
        $updatePassword->bindParam(":correu", $correu);
        if($updatePassword->execute()){
            return true;
        } else {
            return false;
        }
    }

}

function obtenerTotalArticulos($connexio) {
    $query = $connexio->query("SELECT COUNT(*) FROM articles");
    return $query->fetchColumn();
}

function obtenerTotalArticulosPorUsuario($connexio, $correu) {
    $query = $connexio->prepare("SELECT COUNT(*) FROM articles WHERE correu = :correu");
    $query->bindParam(":correu", $correu);
    $query->execute();
    return $query->fetchColumn();
}

function obtenerArticulos($connexio, $start, $articulosPorPagina) {
    $query = $connexio->prepare("SELECT * FROM articles LIMIT :start, :articulosPorPagina");
    $query->bindValue(':start', $start, PDO::PARAM_INT);
    $query->bindValue(':articulosPorPagina', $articulosPorPagina, PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerArticulosPorUsuario($connexio, $start, $articulosPorPagina, $correu) {
    $query = $connexio->prepare("SELECT * FROM articles WHERE correu = :correu LIMIT :start, :articulosPorPagina");
    $query->bindValue(':start', $start, PDO::PARAM_INT);
    $query->bindValue(':articulosPorPagina', $articulosPorPagina, PDO::PARAM_INT);
    $query->bindParam(":correu", $correu);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
?>