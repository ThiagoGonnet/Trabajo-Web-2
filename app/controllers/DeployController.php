<?php
require_once "./app/models/DeployModel.php";
require_once "./config.php";
class DeployController{
  private $model;

  public function __construct(){
    $db = new PDO(
            "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
    $this->model = new DeployModel($db);
  }
    public function deploy()
  {
    $this->model->deploy();
  }
}
