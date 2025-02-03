<?php
header("Content-Type: application/json");
require_once '../database/connexio-api.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $nombre = isset($_GET["nom"]) ? $_GET["nom"] : '';

    try {
        $sql = "SELECT * FROM articles_api WHERE nom LIKE :nom";
        $stmt = $connexio->prepare($sql);
        $stmt->execute(["nom" => "%$nombre%"]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["status" => "success", "data" => $resultados]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}
