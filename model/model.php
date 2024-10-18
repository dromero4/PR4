<?php

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

function insertar($model, $nom, $preu){
    require '../connexio.php';
    $insertarArticle = $connexio->prepare("INSERT INTO articles (model, nom, preu) VALUES(:model, :nom, :preu)");
    $insertarArticle->bindParam(":model", $model);
    $insertarArticle->bindParam(":nom", $nom);
    $insertarArticle->bindParam(":preu", $preu);
    $insertarArticle->execute();

    $ultimID = $connexio->lastInsertId();
    echo "Inserit correctament! ID: $ultimID";
}

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

function modificar($model, $nom, $preu, $id){
    require '../connexio.php';
    if(!empty($model) && !empty($nom) && !empty($preu)){
        $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, nom = :nom, preu = :preu WHERE id = $id");
        $modificarDades->bindParam(':model', $model);
        $modificarDades->bindParam(':nom', $nom);
        $modificarDades->bindParam(':preu', $preu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    } else if(!empty($model) && !empty($nom) && empty($preu)){
        $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, nom = :nom WHERE id = $id");
        $modificarDades->bindParam(':model', $model);
        $modificarDades->bindParam(':nom', $nom);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    } else if(!empty($model) && !empty($preu) && empty($nom)){
        $modificarDades = $connexio->prepare("UPDATE articles SET model = :model, preu = :preu WHERE id = $id");
        $modificarDades->bindParam(':model', $model);
        $modificarDades->bindParam(':preu', $preu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }  else if(!empty($nom) && !empty($preu) && empty($model)){
        $modificarDades = $connexio->prepare("UPDATE articles SET nom = :nom, preu = :preu WHERE id = $id");
        $modificarDades->bindParam(':nom', $nom);
        $modificarDades->bindParam(':preu', $preu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }  else if(!empty($nom) && empty($preu) && empty($model)){
        $modificarDades = $connexio->prepare("UPDATE articles SET nom = :nom WHERE id = $id");
        $modificarDades->bindParam(':nom', $nom);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }  else if(!empty($preu) && empty($nom) && empty($model)){
        $modificarDades = $connexio->prepare("UPDATE articles SET preu = :preu WHERE id = $id");
        $modificarDades->bindParam(':preu', $preu);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }  else if(!empty($model) && empty($nom) && empty($preu)){
        $modificarDades = $connexio->prepare("UPDATE articles SET model = :model WHERE id = $id");
        $modificarDades->bindParam(':model', $model);
        $modificarDades->execute();
        include_once '../vista/modificar.php';
        echo "<br>Article amb ID: $id editat correctament";
    }else {
        include_once '../vista/modificar.php';
        echo "<br>No s'ha modificat cap dada";
    }
    
}

function eliminar($id){

    require '../connexio.php';
    $eliminar = $connexio->prepare("DELETE FROM articles WHERE id = :id");
    $eliminar->bindParam(":id", $id);
    $eliminar->execute();

    if($eliminar){
        return true;
    }
}

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

function insertarUsuari($correu, $usuari, $contrassenya){
    try{
        require '../connexio.php';
        $insertarUsuari = $connexio->prepare("INSERT INTO usuaris(correu, usuari, contrassenya) VALUES(:correu, :usuari, :contrassenya)");
        $insertarUsuari->bindParam(":correu", $correu);
        $insertarUsuari->bindParam(":usuari", $usuari);
        $insertarUsuari->bindParam(":contrassenya", $contrassenya);
        $insertarUsuari->execute();
        if($insertarUsuari){
            return true;
        }
    } catch (PDOException $e){
        echo "";
    }
    
}

function verificarCorreu($correu){
    require '../connexio.php';
    $verificarCorreu = $connexio->prepare("SELECT * FROM usuaris WHERE correu = :correu");
    $verificarCorreu->bindParam(":correu", $correu);
    $verificarCorreu->execute();

    if($verificarCorreu->rowCount() > 0){
        return true;
    }
}

function verificarUsuari($usuari){
    require '../connexio.php';
    $verificarUsuari = $connexio->prepare("SELECT * FROM usuaris WHERE usuari = :usuari");
    $verificarUsuari->bindParam(":usuari", $usuari);
    $verificarUsuari->execute();

    if($verificarUsuari->rowCount() > 0){
        return true;
    }
}

function verificarCompte($usuari, $contrassenya){
    require '../connexio.php';
    $verificarCompte = $connexio->prepare("SELECT * FROM usuaris WHERE usuari = :usuari AND contrassenya = :contrassenya");
    $verificarCompte->bindParam(":usuari", $usuari);
    $verificarCompte->bindParam(":contrassenya", $contrassenya);
    $verificarCompte->execute();

    if($verificarCompte->rowCount() > 0){
        return true;
    }
}
?>