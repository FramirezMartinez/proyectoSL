<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="publico/css/editar_producto.css">
   
    <title>Examen SL - Editar Producto</title>
</head>
<div class="logo-container">
    <a href="index.php">
        <img src="publico/img/regresar.jpg" alt="Logo" title="Regresar">
    </a>
</div>
<h2>Editar Producto</h2>

<body>
<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    // Obtener información del producto por su ID
    $query = "SELECT * FROM Productos WHERE Idproducto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();

    if ($producto) {
        // Mostrar formulario de edición con los datos actuales
?>
      
        <form action="procesar_editar_producto.php" method="post">
            <input type="hidden" name="id" value="<?php echo $producto['Idproducto']; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $producto['Nombre']; ?>" required><br>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $producto['Precio']; ?>" required><br>

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" value="<?php echo $producto['Cantidad']; ?>" required><br>

            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <?php
                $queryTipos = "SELECT * FROM TiposProductos";
                $resultadoTipos = $conexion->query($queryTipos);

                while ($filaTipo = $resultadoTipos->fetch_assoc()) {
                    $selected = ($filaTipo['Idtip'] == $producto['Idtip']) ? 'selected' : '';
                    echo "<option value='{$filaTipo['Idtip']}' {$selected}>{$filaTipo['NombreTipo']}</option>";
                }
                ?>
            </select><br>

            <input type="submit" value="Guardar Cambios">
        </form>
<?php
    } else {
        echo "Producto no encontrado.";
    }

    $stmt->close();
    $conexion->close();
} else {
    header('Location: index.php');
    exit();
}
?>
</body>
</html>
