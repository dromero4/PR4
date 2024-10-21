<!-- David Romero -->
<?php
session_start();
include_once 'navbar.view.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Artículos</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<?php
$articulosPorPagina = 5; // Número d'articles per pàgina
$pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Pàgina actual
$pagina = max($pagina, 1);
$start = ($pagina - 1) * $articulosPorPagina; // Punt d'inici de la consulta

if(!(isset($_SESSION['usuari']))){
    try {
        require '../connexio.php';
        //Numero total d'articles
        $query = $connexio->query("SELECT COUNT(*) FROM articles");
        $total = $query->fetchColumn(); //I ho guardem a una variable

        // Calcular el numero total de pàgines
        $pages = ceil($total / $articulosPorPagina);

        // articles per la pagina actual
        $query = $connexio->prepare("SELECT * FROM articles LIMIT :start, :articulosPorPagina");
        $query->bindValue(':start', $start, PDO::PARAM_INT);
        $query->bindValue(':articulosPorPagina', $articulosPorPagina, PDO::PARAM_INT);
        $query->execute();
        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar els articles
        if ($fetch) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Model</th><th>Nom</th><th>Preu</th><th>Correu</th></tr>";
            foreach ($fetch as $entrada) {
                echo "<tr>
                    <td>".$entrada['id']."</td>
                    <td>".$entrada['model']."</td>
                    <td>".$entrada['nom']."</td>
                    <td>".$entrada['preu']."</td>
                    <td>".$entrada['correu']."</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<br>No se encontraron artículos.";
        }

        // Mostrar la paginació
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
} else {
    try {
        require '../connexio.php';
        // Consulta per comptar el número total d'articles
        $query = $connexio->prepare("SELECT COUNT(*) FROM articles WHERE correu = :correu");
        $query->bindParam(":correu", $_SESSION['correu']);
        $query->execute();

        $total = $query->fetchColumn(); //Numero total d'articles per usuari

        // Calcular el número total de pàgines
        $pages = ceil($total / $articulosPorPagina);

        // Consulta per obtenir els articles per a la pàgina actual
        $query = $connexio->prepare("SELECT * FROM articles WHERE correu = :correu LIMIT :start, :articulosPorPagina");
        $query->bindValue(':start', $start, PDO::PARAM_INT);
        $query->bindValue(':articulosPorPagina', $articulosPorPagina, PDO::PARAM_INT);
        $query->bindParam(":correu", $_SESSION['correu']);
        $query->execute();
        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar els articles
        if ($fetch) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Model</th><th>Nom</th><th>Preu</th><th>Correu</th></tr>";
            foreach ($fetch as $entrada) {
                echo "<tr>
                    <td>".$entrada['id']."</td>
                    <td>".$entrada['model']."</td>
                    <td>".$entrada['nom']."</td>
                    <td>".$entrada['preu']."</td>
                    <td>".$entrada['correu']."</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<br>No se encontraron artículos.";
        }

        // Mostrar la paginació
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
}

?>

</body>
</html>
