<?php
require_once "./app/models/DeployModel.php";

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
    $deployer = new DeployModel($this->db);
    $deployer->deploy();
  }

  public function obtenerUsuario($usuario)
  {
    $query = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $query->execute([$usuario]);
    $userDb = $query->fetch(PDO::FETCH_OBJ);
    return $userDb;
  }
}
