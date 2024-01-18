<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $tipo = $_POST['tipo'];

    // Validar los datos (puedes agregar más validaciones según tus necesidades)

    // Actualizar el producto en la base de datos
    $query = "UPDATE Productos SET Nombre = ?, Precio = ?, Cantidad = ?, Idtip = ? WHERE Idproducto = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('sdisi', $nombre, $precio, $cantidad, $tipo, $idProducto);

    if ($stmt->execute()) {
        // Actualización exitosa
        header('Location: index.php'); // Redirigir a la lista de productos
        exit();
    } else {
        // Error en la actualización
        echo "Error al editar el producto: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    header('Location: index.php');
    exit();
}
?>
