<?php

class DeployModel{
  private $db;

    // Recibe la conexión por el constructor
    public function __construct($db) {
        $this->db = $db;
    }
    public function deploy()
  {
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if (count($tables) == 0) {
      $sql = <<<END
        -- Crear tabla autores si no existe
        CREATE TABLE IF NOT EXISTS `autores` (
          `id_autor` int(11) NOT NULL AUTO_INCREMENT,
          `nombre` varchar(200) NOT NULL,
          `fecha_de_nacimiento` date NOT NULL,
          `nacionalidad` varchar(150) NOT NULL,
          `biografia` text NOT NULL,
          PRIMARY KEY (`id_autor`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- Crear tabla libros si no existe
        CREATE TABLE IF NOT EXISTS `libros` (
          `id_libro` int(11) NOT NULL AUTO_INCREMENT,
          `titulo` varchar(200) NOT NULL,
          `sinopsis` text NOT NULL,
          `anio_de_publicacion` year(4) NOT NULL,
          `disponible` tinyint(1) NOT NULL,
          `tapa_libro` varchar(300) NOT NULL,
          `id_autor` int(11) NOT NULL,
          PRIMARY KEY (`id_libro`),
          KEY `id_autor` (`id_autor`),
          CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        );
        END;
      $this->db->query($sql);
    }
  }
}
