<?php
include_once '../vista/navbar.view.php';
include_once '../vista/reiniciarPassword.php';
include_once '../model/model.php';
if(!empty($contrassenya) && !empty($contrassenyaCanviar)){
    if(verificarCompteCorreu($_SESSION['correu'], $contrassenya)){
        if(verificarContrassenya($contrassenyaCanviar)){
            if(reiniciarPassword($_SESSION['correu'], $contrassenya, $contrassenyaCanviar)){
                $missatges[] = "No s'ha pogut canviar la contrassenya";
            } else {
                $missatges[] = "Password canviada correctament";
                
            }
        } else {
            $missatges[] = 'La contrassenya no és vàlida<br>
                            Ha de tenir com a minim:<br>
                                - 5 caràcters<br>
                                - Una lletra majuscula<br>
                                - Una lletra minuscula<br>
                                - Un numero<br>
                                - Un caràcter especial';
        }
    } else {
        $missatges[] = "Contrassenya incorrecte";
    }
} else {
    $missatges[] = "Has d'omplir els camps";
}


mostrarMissatges($missatges);
?>