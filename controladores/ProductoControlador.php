<?php
class ProductoControlador {
    private $modelo;
    private $vista;

    public function __construct($modelo, $vista) {
        $this->modelo = $modelo;
        $this->vista = $vista;
    }

    // Mostrar la lista de productos
    public function mostrarProductos() {
        $productos = $this->modelo->obtenerProductos();
        $this->vista->mostrarProductos($productos);
    }

}
?>
