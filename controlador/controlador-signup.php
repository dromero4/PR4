<?php
include_once 'controlador.php';
//En cas de ser totes les variables omplertes
if(!empty($usuari) && !empty($contrassenya) && !empty($correu)){
    //encriptem la contrassenya a hash per així ja tenir la contrassenya encriptada
    $contrassenyaHash = password_hash($contrassenya, PASSWORD_DEFAULT);
    include_once '../vista/signup.php';
    //Verifiquem si el correu es més llarg de 40 caràcters
    if(strlen($correu) > 40){
        echo "<br>El correu ha de tenir menys de 40 caràcters...";
    } else if (verificarCorreu($correu, $connexio)){ //Verifiquem si ja existeix el correu
        echo "<br>El correu ja existeix";
    } else {
        if(strlen($usuari) > 20){ //verifiquem que no sigui massa llarg el nom d'usuari
            echo "<br>El nom d'usuari ha de tenir menys de 20 caràcters...";
        } else if(verificarUsuari($usuari, $connexio)){ //I verifiquem que no existeixi previament
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
                    if(insertarUsuari($correu, $usuari, $contrassenyaHash, $connexio)){ //En cas de ser tot correcte, inserim l'usuari a la base de dades amb la contrassenya encriptada
                        echo  "<br>Usuari creat correctament<br>";
                        ?>
                        <a href="../vista/login.php"><button>Fes login</button></a>
                        <?php
                    } else {
                        //En cas d'haver algun error
                        include_once '../vista/signup.php';
                        echo  "<br>No s'ha pogut crear l'usuari";
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
    include_once '../vista/signup.php';
    echo "<br>Has d'introduïr les dades...";
}
?>

