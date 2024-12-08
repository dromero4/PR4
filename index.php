<?php
session_start();

require_once __DIR__ . '/database/env.php';
include BASE_PATH . 'vista/navbar.view.php';
require_once 'database/connexio.php';
require_once 'model/model.php';

$articulosPorPagina = $_POST['post_per_page'] ?? ($_COOKIE['post_per_page'] ?? 10); // Default 10
$orderBy = $_POST['orderBy'] ?? ($_COOKIE['orderBy'] ?? 'dateAsc'); // Default 'dateAsc'

// Guardar las opciones en cookies
if ($orderBy) {
    setcookie('orderBy', $orderBy, time() + (86400 * 30), "/");
}
if ($articulosPorPagina) {
    setcookie('post_per_page', $articulosPorPagina, time() + (86400 * 30), "/");
}

// Determinar la página actual
$pagina = isset($_GET['page']) && $_GET['page'] > 0 ? intval($_GET['page']) : 1;

// Calcular el inicio para la paginación
$start = ($pagina - 1) * $articulosPorPagina;
try {
    if (!isset($_SESSION['usuari'])) {
        // Usuario no autenticado
        $total = obtenerTotalArticulos($connexio);
        $pages = ceil($total / $articulosPorPagina);
        $fetch = obtenerArticulos($connexio, $start, $articulosPorPagina, $orderBy);
    } else {
        // Usuario autenticado
        $total = obtenerTotalArticulosPorUsuario($connexio, $_SESSION['correu']);
        $pages = ceil($total / $articulosPorPagina);
        $fetch = obtenerArticulosPorUsuario($connexio, $start, $articulosPorPagina, $_SESSION['correu'], $orderBy);
    }

    // Mostrar los artículos
    if ($fetch) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Model</th><th>Nom</th><th>Preu</th><th>Correu</th></tr>";
        foreach ($fetch as $entrada) {
            echo "<tr>
                <td>{$entrada['id']}</td>
                <td>{$entrada['model']}</td>
                <td>{$entrada['nom']}</td>
                <td>{$entrada['preu']}</td>
                <td>{$entrada['correu']}</td>
            </tr>";
        }
        echo "</table>";

        
    } else {
        echo "<br>No se encontraron artículos.";
       
    }

?>
<div class="pagination">
    <?php if ($pages > 1): ?>
        <!-- Flecha anterior -->
        <?php if ($pagina > 1): ?>
            <a href="?page=<?= $pagina - 1; ?>" class="arrow">&laquo;</a>
        <?php endif; ?>

        <!-- Mostrar solo 3 botones en función de la página actual -->
        <?php
        $start = max(1, $pagina - 1); // Calcula el inicio del rango
        $end = min($pages, $start + 2); // Calcula el fin del rango
        for ($i = $start; $i <= $end; $i++): ?>
            <a href="?page=<?= htmlspecialchars($i); ?>" 
               class="<?= $i === $pagina ? 'active' : ''; ?>">
                <?= htmlspecialchars($i); ?>
            </a>
        <?php endfor; ?>

        <!-- Flecha siguiente -->
        <?php if ($pagina < $pages): ?>
            <a href="?page=<?= $pagina + 1; ?>" class="arrow">&raquo;</a>
        <?php endif; ?>
    <?php endif; ?>
</div>


<?php 
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <form action="#" method="post">
        <label for="orderBy">Order by || Post Per Page</label>
        <select name="orderBy" id="orderBy">
            <option value="dateAsc" <?= $orderBy === 'dateAsc' ? 'selected' : '' ?>>Date (Asc)</option>
            <option value="dateDesc" <?= $orderBy === 'dateDesc' ? 'selected' : '' ?>>Date (Desc)</option>
            <option value="AlphabeticallyAsc" <?= $orderBy === 'AlphabeticallyAsc' ? 'selected' : '' ?>>Alphabetically (Asc)</option>
            <option value="AlphabeticallyDesc" <?= $orderBy === 'AlphabeticallyDesc' ? 'selected' : '' ?>>Alphabetically (Desc)</option>
        </select>

        <select name="post_per_page" id="post_per_page">
            <option value="5" <?= $articulosPorPagina == 5 ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $articulosPorPagina == 10 ? 'selected' : '' ?>>10</option>
            <option value="15" <?= $articulosPorPagina == 15 ? 'selected' : '' ?>>15</option>
            <option value="20" <?= $articulosPorPagina == 20 ? 'selected' : '' ?>>20</option>
        </select>

        <br><br>
        <input type="submit" name="OrderBy" value="Enviar">
    </form>
</body>
</html>
