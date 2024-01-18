
CREATE DATABASE base1;


USE base1;


CREATE TABLE TiposProductos (
    Idtip INT PRIMARY KEY,
    NombreTipo VARCHAR(50)
) ENGINE=InnoDB;


CREATE TABLE Productos (
    Idproducto INT  PRIMARY KEY,
    Nombre VARCHAR(50),
    Precio DECIMAL(10, 2),
    Cantidad INT(10),
    Idtip INT,
    FOREIGN KEY (Idtip) REFERENCES TiposProductos(Idtip)
) ENGINE=InnoDB;


INSERT INTO TiposProductos (Idtip, NombreTipo) VALUES
(1, 'Motos'),
(2, 'Accesorios para Motos'),
(3, 'Ropa para Motociclistas'),
(4, 'Repuestos y Componentes');


INSERT INTO Productos (Idproducto, Nombre, Precio, Cantidad, Idtip) VALUES
(1, 'Motocicleta Sport 200cc', 4999.99, 10, 1),
(2, 'Casco Integral', 129.99, 50, 2),
(3, 'Chaqueta de Cuero para Motociclista', 199.99, 30, 3),
(4, 'Frenos de Disco para Moto', 49.99, 100, 4),
(5, 'Aceite para Motor de Moto', 9.99, 200, 4),
(6, 'Guantes de Motociclista', 29.99, 50, 3),
(7, 'Escape Deportivo para Moto', 149.99, 20, 4),
(8, 'Botas para Motocross', 89.99, 40, 3),
(9, 'Llanta Trasera para Moto Deportiva', 79.99, 25, 4),
(10, 'Kit de Herramientas para Moto', 39.99, 15, 2);
