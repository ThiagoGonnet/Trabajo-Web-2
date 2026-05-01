<?php

class AuthModel
{
  private $db;
  public function __construct()
  {
    $this->db = new PDO(
      "mysql:host=" . MYSQL_HOST .
        ";dbname=" . MYSQL_DB . ";charset=utf8",
      MYSQL_USER,
      MYSQL_PASS
    );
    $this->deploy();
  }

  private function deploy()
  {
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll();
    if (count($tables) == 0) {
      $sql = <<<END
        CREATE TABLE IF NOT EXISTS ejemplo (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(50)
        );
        END;
      $this->db->query($sql);
    }
  }

  public function obtenerUsuario($usuario)
  {
    $query = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $query->execute([$usuario]);
    $contraseña = $query->fetch(PDO::FETCH_OBJ);
    return $contraseña;
  }
}
