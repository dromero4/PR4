<?php
session_start();
require_once __DIR__ . '/database/env.php';
include BASE_PATH . 'vista/navbar.view.php';
require_once 'database/connexio.php';
require_once 'model/model.php';

$articulosPorPagina = 5; // Definir la cantidad de artículos por página

if (!(isset($_SESSION['usuari']))) {
    try {
        // Definir la página actual
        if (!isset($_GET['page']) || $_GET['page'] < 1) {
            $pagina = 1;
        } else {
            $pagina = $_GET['page'];
        }

        // Calcular el valor de $start para la paginación
        $start = ($pagina - 1) * $articulosPorPagina;

        // Número total de artículos
        $total = obtenerTotalArticulos($connexio);
        $pages = ceil($total / $articulosPorPagina);  // Calcular el número total de páginas

        // Artículos para la página actual
        $fetch = obtenerArticulos($connexio, $start, $articulosPorPagina);

        // Mostrar los artículos
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
} else {
    try {

        // Definir la página actual
        if (!isset($_GET['page']) || $_GET['page'] < 1) {
            $pagina = 1;
        } else {
            $pagina = $_GET['page'];
        }

        // Calcular el valor de $start para la paginación
        $start = ($pagina - 1) * $articulosPorPagina;

        // Número total de artículos para el usuario
        $total = obtenerTotalArticulosPorUsuario($connexio, $_SESSION['correu']);
        $pages = ceil($total / $articulosPorPagina);

        // Artículos para la página actual del usuario
        $fetch = obtenerArticulosPorUsuario($connexio, $start, $articulosPorPagina, $_SESSION['correu']);

        // Mostrar los artículos
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
}
?>
