<?php

class ProductoVista {

    // Mostrar la lista de productos con estilos
    public function mostrarProductos($productos) {
        echo '<div class="productos-container">';
        foreach ($productos as $producto) {
            echo "<div class='producto'>ID: {$producto['Idproducto']}, Nombre: {$producto['Nombre']}, Precio: {$producto['Precio']}, Cantidad: {$producto['Cantidad']}, Tipo: {$producto['TipoNombre']}</div>";
        }
        echo '</div>';
    }

   
}
