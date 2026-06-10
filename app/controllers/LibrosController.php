<?php
require_once "./app/models/LibrosModel.php";
require_once "./app/views/LibrosView.php";
require_once "./app/views/ErrorView.php";
require_once "./app/models/AutoresModel.php";
require_once "./app/controllers/AuthController.php";

class LibrosController
{
  private $model;
  private $view;
  private $errorView;
  private $autoresModel;
  private $authController;

  public function __construct()
  {
    $this->model = new LibrosModel();
    $this->view = new LibrosView();
    $this->errorView = new ErrorView();
    $this->autoresModel = new AutoresModel();
    $this->authController = new AuthController();
  }
  public function mostrarHome()
  {
    $this->view->mostrarHome();
  }
  public function obtenerLibros()
  {
    return $this->model->obtenerLibros();
  }
  /*public function mostrarInicioLibros()
  {
    $autores = $this->autoresModel->obtenerAutores();
    $libros = $this->model->obtenerLibros();
    $this->view->mostrarLibros($libros, $autores);
  }*/
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
    $this->authController->usuarioLogueado();
    if (empty($_POST['titulo']) || empty($_POST['anio']) || empty($_POST['sinopsis']) || empty($_POST['disponible']) || empty($_POST['autor'])) {
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }
    $titulo = $_POST['titulo'];
    $anio = $_POST['anio'];
    $sinopsis = $_POST['sinopsis'];
    $disponible = $_POST['disponible'];
    var_dump($disponible);
    $autor = $_POST['autor'];
    $this->model->agregarLibro($titulo, $sinopsis, $anio, $disponible, $autor);

    header("Location: " . BASE_URL);
  }

  public function eliminarLibro()
  {
    $this->authController->usuarioLogueado();
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
    $this->authController->usuarioLogueado();

    if (
      empty($_POST['id_libro']) ||
      empty($_POST['titulo']) ||
      empty($_POST['anio']) ||
      empty($_POST['sinopsis']) ||
      empty($_POST['autor'])
    ) {

      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }

    $id_libro = $_POST['id_libro'];
    $titulo = $_POST['titulo'];
    $anio = $_POST['anio'];
    $sinopsis = $_POST['sinopsis'];
    $autor = $_POST['autor'];
    $tapa = $_POST['tapa'];

    if (isset($_POST['disponible'])) {
      $disponible = 1;
    } else {
      $disponible = 0;
    }

    $this->model->actualizarLibro(
      $id_libro,
      $titulo,
      $sinopsis,
      $anio,
      $disponible,
      $tapa,
      $autor
    );

    header("Location: " . BASE_URL);
  }
}
