<!-- David Romero -->

<?php 
$direccio = "https://www.davidromero.cat";
$nomBBDD = "ddb237123";
$usuaris = "ddb237123";
$contrasenya = "davidD1234%";

//  fitxer per a la connexio a la base de dades
    try{
        $connexio = new PDO("mysql:host=$direccio;dbname=$nomBBDD;charset=utf8", $usuaris, $contrasenya);
        $connexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "No s'ha pogut connectar a la base de dades...";
    }
    
?>