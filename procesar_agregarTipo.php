<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $idTipo = $_POST['idtp'];
    $nombreTipo = $_POST['nombre'];

    // Validar los datos si es necesario

    // Insertar el nuevo tipo de producto si no existe
    $queryTipo = "INSERT IGNORE INTO TiposProductos (Idtip, NombreTipo) VALUES (?, ?)";
    $stmtTipo = $conexion->prepare($queryTipo);

    // Ajustar la cadena de definición de tipo y la vinculación de parámetros
    $stmtTipo->bind_param('ss', $idTipo, $nombreTipo);

    if ($stmtTipo->execute()) {
        // Inserción exitosa
        header('Location: index.php'); // Redirigir a la lista de productos
        exit();
    } else {
        // Error en la inserción del tipo de producto
        echo "Error al agregar el tipo de producto: " . $stmtTipo->error;
    }

    $stmtTipo->close();
    $conexion->close();
} else {
    // Si no se enviaron datos por el formulario, redirigir a la página de inicio
    header('Location: index.php');
    exit();
}
?>
