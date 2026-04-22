<?php
require_once "./app/models/AutoresModel.php";
require_once "./app/views/AutoresView.php";
require_once "./app/views/ErrorView.php";

class AutoresController
{
  private $model;
  private $view;
  private $errorView;

  public function __construct()
  {
    $this->model = new AutoresModel();
    $this->view = new AutoresView();
    $this->errorView = new ErrorView();
  }
  public function obtenerAutores()
  {
    $autores = $this->model->obtenerAutores();
    //-------AGREGO SIGNO PARA QUE NO APAREZCAN EN EL HOME LOS AUTORES!!!!--------------
    if (!empty($autores)) {
      $msj = "No hay ningún autor cargado.";
      header("Location: ", BASE_URL);
    } else {
      $this->view->mostrarAutores($autores);
    }
  }
  public function mostrarAutorPorId($id)
  {
    $libro = $this->model->obtenerAutorPorId($id);
    if (empty($autor)) {
      $msj = "No hay ningún autor cargado.";
      $this->errorView->mostrarError($msj);
    } else {
      $this->view->mostrarAutorPorId($autor);
    }
  }
  public function agregarAutor()
  {
    if (empty($_POST['nombre']) || empty($_POST['fechaDeNacimeinto']) || empty($_POST['nacionalidad']) || empty($_POST['biografia'])) {
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
    }
    $nombre = $_POST['nombre'];
    $fechaDeNacimiento = $_POST['fechaDeNacimiento'];
    $nacionalidad = $_POST['nacionalidad'];
    $biografia = $_POST['biografia'];
    $this->model->agregarAutor($nombre, $fechaDeNacimiento, $nacionalidad, $biografia);
    header("Location: " . BASE_URL);
  }

  public function eliminarAutor()
  {
    if (empty($_POST['autorAEliminar'])) {
      $msj = "Elija un autor por favor.";
      $this->errorView->mostrarError($msj);
    } else {
      $id_autor = $_POST['autorAEliminar'];
      $this->model->eliminarAutor($id_autor);
    }
    header("Location: " . BASE_URL);
  }

  public function actualizarAutor()
  {
    if (empty($_POST['nombre']) || empty($_POST['fechaDeNacimeinto']) || empty($_POST['nacionalidad']) || empty($_POST['biografia'])) {
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
    }
    $nombre = $_POST['nombre'];
    $fechaDeNacimiento = $_POST['fechaDeNacimiento'];
    $nacionalidad = $_POST['nacionalidad'];
    $biografia = $_POST['biografia'];
    $this->model->actualizarAutor($nombre, $fechaDeNacimiento, $nacionalidad, $biografia);

    header("Location: " . BASE_URL);
  }
}
