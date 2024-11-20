<!-- David Romero -->

<?php 
require_once 'env.php';

$direccio = DB_VAR['DB_HOST'];
$nomBBDD = DB_VAR['DB_NAME'];
$usuaris = DB_VAR['DB_USER'];
$contrasenya = DB_VAR['DB_PASSWORD'];

//  fitxer per a la connexio a la base de dades
    try{
        $connexio = new PDO("mysql:host=$direccio;dbname=$nomBBDD;charset=utf8", $usuaris, $contrasenya);
        $connexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "No s'ha pogut connectar a la base de dades...". $e->getMessage();
    }
    
?>