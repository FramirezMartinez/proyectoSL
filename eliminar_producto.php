<?php
// Incluir el archivo de configuración
require_once 'config.php';

// Verificar si se recibió un ID de producto válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idProducto = $_GET['id'];

    // Eliminar el producto de la base de datos
    $query = "DELETE FROM Productos WHERE Idproducto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $idProducto);

    if ($stmt->execute()) {
        // Eliminación exitosa
        header('Location: index.php'); // Redirigir a la lista de productos
        exit();
    } else {
        // Error en la eliminación
        echo "Error al eliminar el producto: " . $stmt->error;
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conexion->close();
} else {
    // Si no se proporcionó un ID de producto válido, redirigir a la página de inicio
    header('Location: index.php');
    exit();
}
?>
