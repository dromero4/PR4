<?php 
require_once '../oauth/oauth.php';

if(isset($_GET['code'])){
    $code = $_GET['code'];
    var_dump($code);
} else {
    echo "Hola";
}
?>