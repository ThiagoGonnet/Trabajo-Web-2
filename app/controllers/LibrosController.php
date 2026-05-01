<?php
require_once "./app/models/LibrosModel.php";
require_once "./app/views/LibrosView.php";
require_once "./app/views/ErrorView.php";
require_once "./app/controllers/AutoresController.php";

class LibrosController
{
  private $model;
  private $view;
  private $errorView;
  private $autoresController;

  public function __construct()
  {
    $this->model = new LibrosModel();
    $this->view = new LibrosView();
    $this->errorView = new ErrorView();
    $this->autoresController = new AutoresController();
  }
  /*public function showHome(){
    session_start();
    $this->view->mostrarHeader();
    $libros = $this->model->mostrarInicioLibros();
    //if (!empty($_SESSION) && $_SESSION['logged']){
     // $this->view->showCRUD($_SESSION['userName'],$categorias);
      //$this->view->renderListProduct($products,$_SESSION['logged']);
    //}else{
      $this->view->mostrarHeader($libros);
    //}
   // $this->view->bodyHome();
    $this->view->mostrarFooter();
  }*/
  public function usuarioLogueado()
  {
    if (!isset($_SESSION['ID_USER'])) {
      return header('Location: ' . BASE_URL . 'login');
      die();
    }
  }
  public function mostrarInicioLibros()
  {
    $autores = $this->autoresController->obtenerAutores(); // chequear si se puede usar el controller de autores en el controller de libros
    $libros = $this->model->obtenerLibros();
    $this->view->mostrarInicioLibros($libros, $autores);
  }
  public function mostrarLibros()
  {
    $libros = $this->model->obtenerLibros();
    if (empty($libros)) {
      $msj = "No hay ningún libro cargado.";
      header("Location: ", BASE_URL);
    } else {
      $this->view->mostrarLibros($libros);
    }
  }

  public function mostrarLibroPorId($id)
  {
    $libro = $this->model->obtenerLibroPorId($id);
    if (empty($libro)) {
      $msj = "No hay ningún libro cargado.";
      $this->errorView->mostrarError($msj);
      die();
    } else {
      $this->view->mostrarLibroPorId($libro);
    }
  }

  public function agregarLibro()
  {
    $this->usuarioLogueado();
    if (empty($_POST['titulo']) || empty($_POST['anio']) || empty($_POST['sinopsis']) || empty($_POST['disponible']) || empty($_POST['autor'])) {
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }
    $titulo = $_POST['titulo'];
    $anio = $_POST['anio'];
    $sinopsis = $_POST['sinopsis'];
    $disponible = $_POST['disponible'];
    $autor = $_POST['autor'];
    $this->model->agregarLibro($titulo, $sinopsis, $anio, $disponible, $autor);

    header("Location: " . BASE_URL);
  }

  public function eliminarLibro()
  {
    $this->usuarioLogueado();
    if (empty($_POST['libroAEliminar'])) {
      $msj = "Elija un libro por favor.";
      $this->errorView->mostrarError($msj);
      die();
    } else {
      $id_libro = $_POST['libroAEliminar'];
      $this->model->eliminarLibro($id_libro);
    }
    header("Location: " . BASE_URL);
  }

  public function actualizarLibro()
  {
    $this->usuarioLogueado();
    if (empty($_POST['titulo']) || empty($_POST['anio']) || empty($_POST['sinopsis']) || empty($_POST['disponible']) || empty($_POST['autor'])) {
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }
    $titulo = $_POST['titulo'];
    $anio = $_POST['anio'];
    $sinopsis = $_POST['sinopsis'];
    $disponible = $_POST['disponible'];
    $autor = $_POST['autor'];
    $this->model->actualizarLibro($titulo, $sinopsis, $anio, $disponible, $autor);

    header("Location: " . BASE_URL);
  }
}
