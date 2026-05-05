<?php
require_once "./app/models/DeployModel.php";

class DeployController(){
  private $model;

  public function __construct(){
    $this->model = new DeployModel();
  }
    private function deploy()
  {
    $this->model->deploy();
  }
}
