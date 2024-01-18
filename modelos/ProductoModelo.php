<?php
class ProductoModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Obtener todos los productos con información del tipo y cantidad
    public function obtenerProductos() {
        $query = "SELECT productos.*, TiposProductos.NombreTipo AS TipoNombre FROM productos JOIN TiposProductos ON productos.Idtip = TiposProductos.Idtip";
        $resultado = $this->conexion->query($query);

        $productos = array();

        while ($row = $resultado->fetch_assoc()) {
            $productos[] = $row;
        }

        return $productos;
    }
}

?>

