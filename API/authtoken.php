<?php
require_once '../database/connexio-api.php';

// // Generar un token aleatorio
// function generarToken()
// {
//     return bin2hex(random_bytes(32));
// }

// // Verificar si el token es válido
// function validarToken($pdo, $token)
// {
//     $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE token = ?");
//     $stmt->execute([$token]);
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }
