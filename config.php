<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$nombreBaseDatos = 'base4';

// Crear la conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $nombreBaseDatos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>
