<!-- David Romero -->

<?php
require_once 'env-api.php';

$direccio = DB_VAR['DB_HOST2'];
$nomBBDD = DB_VAR['DB_NAME2'];
$usuaris = DB_VAR['DB_USER2'];
$contrasenya = DB_VAR['DB_PASSWORD2'];

//  fitxer per a la connexio a la base de dades
try {
    $connexio1 = new PDO("mysql:host=$direccio;dbname=$nomBBDD;charset=utf8", $usuaris, $contrasenya);
    $connexio1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "No s'ha pogut connectar a la base de dades..." . $e->getMessage();
}

?>