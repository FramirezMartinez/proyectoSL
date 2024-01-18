<?php
// Incluir el archivo de configuración
require_once 'config.php';

// Verificar si se enviaron datos por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $tipo = $_POST['tipo'];

   

    // Insertar el nuevo producto en la base de datos
    $queryProducto = "INSERT INTO Productos (Idproducto, Nombre, Precio, Cantidad, Idtip) VALUES (?, ?, ?, ?, ?)";
    $stmtProducto = $conexion->prepare($queryProducto);
    $stmtProducto->bind_param('ssdis', $clave, $nombre, $precio, $cantidad, $tipo);

    if ($stmtProducto->execute()) {
        // Inserción exitosa
        header('Location: index.php'); // Redirigir a la lista de productos
        exit();
    } else {
        // Error en la inserción del producto
        echo "Error al agregar el producto: " . $stmtProducto->error;
    }

    $stmtProducto->close();
    $conexion->close();
} else {
    // Si no se enviaron datos por el formulario, redirigir a la página de inicio
    header('Location: index.php');
    exit();
}
?>
