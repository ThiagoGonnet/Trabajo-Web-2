<?php
require_once "./app/models/LibrosModel.php";
require_once "./app/views/LibrosView.php";
require_once "./app/views/ErrorView.php";

class LibrosController{
  private $model;
  private $view;
  private $errorView;

  public function __construct(){
    $this->model = new LibrosModel();
    $this->view = new LibrosView();
    $this->errorView = new ErrorView();
  }
  public function mostrarLibros(){
    $libros = $this->model->obtenerLibros();
    if(empty($libros)){
      $msj = "No hay ningún libro cargado.";
      $this->errorView->mostrarError($msj);
    } else {
      $this->view->mostrarLibros($libros);
    }
  }

  public function mostrarLibroPorId($id){
    $libro = $this->model->obtenerLibroPorId($id);
    if(empty($libro)){
      $msj = "No hay ningún libro cargado.";
      $this->errorView->mostrarError($msj);
    } else {
      $this->view->mostrarLibroPorId($libro);
    }
  }

  public function agregarLibro(){
    if(empty($_POST['titulo']) || empty($_POST['anio']) || empty($_POST['sinopsis']) || empty($_POST['disponible']) || empty($_POST['tapa']) || empty($_POST['autor'])){
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
    }
    $titulo = $_POST['titulo'];
    $anio = $_POST['anio'];
    $sinopsis = $_POST['sinopsis'];
    $disponible = $_POST['disponible'];
    $tapa = $_POST['tapa'];
    $autor = $_POST['autor'];
    $this->model->agregarLibro($titulo, $sinopsis, $anio, $disponible, $tapa, $autor);

    header("Location: ", BASE_URL);
  }

  public function eliminarLibro(){}

  public function actualizarLibro(){}
}
