<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="publico/css/estilosvista.css">
   
    <title>Examen SL</title>
</head>
<body> 

<?php
// Incluir el archivo de configuración
require_once 'config.php';

// Cargar los modelos, vistas y controladores necesarios
require_once 'modelos/ProductoModelo.php';
require_once 'vistas/ProductoVista.php';
require_once 'controladores/ProductoControlador.php';
// Incluir el script de búsqueda
//require_once 'vistas/buscar_productos.php';

// Crear instancias de los modelos, vistas y controladores, pasando la conexión
$productoModelo = new ProductoModelo($conexion);
$productoVista = new ProductoVista();
$productoControlador = new ProductoControlador($productoModelo, $productoVista);

// Obtener la lista de productos con información del tipo y cantidad
$productos = $productoModelo->obtenerProductos();

?>

<form id="buscar-form" action="buscar_productos.php" method="get">
  
    <input type="text" id="busqueda" name="busqueda" placeholder="Buscar el nombre del producto..." required>
    <input type="submit" value="Buscar">
</form>


<form id="agregarTipoForm" class="hidden-form" action="procesar_agregarTipo.php" method="post">
<h4 id="titulotp">Agregar tipo producto</h4>
<br>
 <label for="idtp">Código tipo producto:</label>
    <input type="text" id="idtp" name="idtp" required><br>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

   

    <input type="submit" value="Agregar">
</form>





<form id="agregarProductoForm" class="hidden-form" action="procesar_agregar.php" method="post">
<h4 id="titulo">Agregar producto</h4>
<br>
<label for="Clave">Código producto:</label>
    <input type="text" id="clave" name="clave" required><br>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" step="0.01" required><br>

    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" required><br>

    <label for="tipo">Tipo:</label>
    <select id="tipo" name="tipo" required>
        <?php
        $queryTipos = "SELECT * FROM TiposProductos";
        $resultadoTipos = $conexion->query($queryTipos);

        while ($filaTipo = $resultadoTipos->fetch_assoc()) {
            echo "<option value='{$filaTipo['Idtip']}'>{$filaTipo['NombreTipo']}</option>";
        }
        ?>
    </select><br>

    <input type="submit" value="Agregar Producto">
</form>


<?php
echo "<h2 style='text-align: center;'>Lista de productos</h2>";
?>

<?php
echo '<div class="inline-buttons">';
echo '    <h5 id="btnTP" onclick="toggleForm(\'agregarTipoForm\')">Agregar Tipo Producto</h5>';
echo '    <h5 id="btnP" onclick="toggleForm(\'agregarProductoForm\')">Agregar Producto</h5>';
echo '</div>';
?>


<?php
echo "<table class='productos-table'>";
echo "<thead><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Tipo</th><th>Acciones</th></tr></thead>";
echo "<tbody>";

foreach ($productos as $producto) {
    echo "<tr>";
    echo "<td>{$producto['Idproducto']}</td>";
    echo "<td>{$producto['Nombre']}</td>";
    echo "<td>{$producto['Precio']}</td>";
    echo "<td>{$producto['Cantidad']}</td>";
    echo "<td>{$producto['TipoNombre']}</td>";
    echo "<td class='acciones'>
            <a href='editar_producto.php?id={$producto['Idproducto']}' class='edit-button'>Editar</a>
            <a href='eliminar_producto.php?id={$producto['Idproducto']}' class='delete-button'>Eliminar</a>
          </td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";


// Cerrar la conexión a la base de datos
$conexion->close();
?>

<script src="publico/js/formularios.js"></script>
</body>
</html>
