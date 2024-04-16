CREATE TABLE series (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    genero VARCHAR(100),
    descripcion TEXT,
    anio_lanzamiento INT,
    puntuacion DECIMAL(3,1)
);
