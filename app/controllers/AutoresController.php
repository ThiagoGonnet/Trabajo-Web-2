<?php
require_once "./app/models/AutoresModel.php";
// require_once "./app/views/AutoresView.php";
require_once "./app/views/ErrorView.php";

class AutoresController
{
  private $model;
  private $view;
  private $errorView;

  public function __construct()
  {
    $this->model = new AutoresModel();
    // $this->view = new AutoresView();
    $this->errorView = new ErrorView();
  }
  public function obtenerAutores()
  {
    $autores = $this->model->obtenerAutores();
    return $autores;
  }
}
