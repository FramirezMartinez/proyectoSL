<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="publico/css/buscarproducto.css">
    <div class="logo-container">
    <a href="index.php">
        <img src="publico/img/regresar.jpg" alt="Logo" width="50" height="50">
    </a>
</div>
    <title>Resultados de Búsqueda</title>
 
</head>
<body>

<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['busqueda'])) {
    $terminoBusqueda = $_GET['busqueda'];

  
    $query = "SELECT p.*, tp.NombreTipo FROM Productos p
              LEFT JOIN TiposProductos tp ON p.Idtip = tp.Idtip
              WHERE p.Nombre LIKE ?";
    $stmt = $conexion->prepare($query);

    // Añadir '%' para permitir búsquedas parciales
    $terminoBusqueda = "%$terminoBusqueda%";
    $stmt->bind_param('s', $terminoBusqueda);
    $stmt->execute();

    $result = $stmt->get_result();
    $productos = $result->fetch_all(MYSQLI_ASSOC);
    
    echo "<h2>Resultados de la búsqueda:</h2>";
    echo "<table class='productos-table'>";
    echo "<tr><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Tipo</th><th>Acciones</th></tr>";

    foreach ($productos as $producto) {
        echo "<tr>";
       
        echo "<td>{$producto['Nombre']}</td>";
        echo "<td>{$producto['Precio']}</td>";
        echo "<td>{$producto['Cantidad']}</td>";
        echo "<td>{$producto['NombreTipo']}</td>"; // Tipo de producto obtenido de la tabla TiposProductos

        echo "<td class='acciones'>";
        echo "<a href='editar_producto.php?id={$producto['Idproducto']}' class='edit-button'>Editar</a>";
        echo "<a href='eliminar_producto.php?id={$producto['Idproducto']}' class='delete-button'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";

    echo "</table>";
}
}
?>
</body>
</html>
