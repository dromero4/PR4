<!-- David Romero -->
<?php
include_once 'navbar.view.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Artículos</title>
</head>
<body>

<?php
// Configuración de la paginación
$articulosPorPagina = 5; // Número de artículos por página
$pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual
$pagina = max($pagina, 1);
$start = ($pagina - 1) * $articulosPorPagina; // Punto de inicio de la consulta

try {
    require '../connexio.php';
    // Consulta para contar el número total de artículos
    $query = $connexio->query("SELECT COUNT(*) FROM articles");
    $total = $query->fetchColumn(); // Total de artículos

    // Calcular el número total de páginas
    $pages = ceil($total / $articulosPorPagina);

    // Consulta para obtener los artículos para la página actual
    $query = $connexio->prepare("SELECT * FROM articles LIMIT :start, :articulosPorPagina");
    $query->bindValue(':start', $start, PDO::PARAM_INT);
    $query->bindValue(':articulosPorPagina', $articulosPorPagina, PDO::PARAM_INT);
    $query->execute();
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los artículos
    if ($fetch) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Model</th><th>Nom</th><th>Preu</th></tr>";
        foreach ($fetch as $entrada) {
            echo "<tr>
                <td>".$entrada['id']."</td>
                <td>".$entrada['model']."</td>
                <td>".$entrada['nom']."</td>
                <td>".$entrada['preu']."</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron artículos.";
    }

    // Mostrar la paginación
    if ($pages > 1): ?>
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?page=<?= htmlspecialchars($i); ?>" 
               class="<?= $i === $pagina ? 'active' : ''; ?>">
                <?= htmlspecialchars($i); ?>
            </a>
        <?php endfor; ?>
    <?php endif; ?>

<?php
} catch (PDOException $e) {
    
    echo "Error: " . $e->getMessage();
}
?>

</body>
</html>
