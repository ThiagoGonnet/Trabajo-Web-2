<?php

require_once "./app/models/LibrosModel.php";
require_once "./app/views/LibrosView.php";
require_once "./app/views/ErrorView.php";
require_once "./app/models/AutoresModel.php";

class LibrosController
{
  private $model;
  private $view;
  private $errorView;
  private $autoresModel;
  
  public function __construct()
  {
    $this->model = new LibrosModel();
    $this->view = new LibrosView();
    $this->errorView = new ErrorView();
    $this->autoresModel = new AutoresModel();
  }

  public function mostrarHome()
  {
    $this->view->mostrarHome();
  }

  public function obtenerLibros()
  {
    return $this->model->obtenerLibros();
  }

  public function mostrarLibros()
  {
    $libros = $this->model->obtenerLibros();

    if (empty($libros)) {
      $msj = "No hay ningún libro cargado.";
      $this->errorView->mostrarError($msj);
      die();
    }

    $this->view->mostrarLibros($libros);
  }

  public function mostrarLibroPorId($id)
  {
    if (!isset($id)) {
      $msj = "ID inválido.";
      $this->errorView->mostrarError($msj);
      die();
    }

    $libro = $this->model->obtenerLibroPorId($id);

    if (empty($libro)) {
      $msj = "No existe el libro.";
      $this->errorView->mostrarError($msj);
      die();
    }

    $this->view->mostrarLibroPorId($libro);
  }

  public function agregarLibro()
  {

    if (
      !isset($_POST['titulo']) ||
      !isset($_POST['anio']) ||
      !isset($_POST['sinopsis']) ||
      !isset($_POST['autor'])
    ) {
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }

    if (!is_numeric($_POST['anio'])) {
      $msj = "Ingrese un año válido por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }

    if (empty($_POST['titulo']) || empty($_POST['anio']) || empty($_POST['sinopsis']) || empty($_POST['autor'])) {
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }

    $titulo = ($_POST['titulo']);
    $anio = $_POST['anio'];
    $sinopsis = ($_POST['sinopsis']);
    $autor = $_POST['autor'];

    if (isset($_POST['disponible'])) {
      $disponible = 1;
    } else {
      $disponible = 0;
    }

    $autorExiste = $this->autoresModel->obtenerAutorPorId($autor);
    if (!$autorExiste) {
      $msj = "El autor no existe.";
      $this->errorView->mostrarError($msj);
      die();
    }

    $this->model->agregarLibro($titulo, $sinopsis, $anio, $disponible, $autor);

    header("Location: " . BASE_URL);
  }

  public function eliminarLibro()
  {

    if (!isset($_POST['libroAEliminar'])) {
      $msj = "Elija un libro válido por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }

    $id_libro = $_POST['libroAEliminar'];

    $this->model->eliminarLibro($id_libro);

    header("Location: " . BASE_URL);
  }

  public function actualizarLibro()
  {

    if (
      !isset($_POST['id_libro']) ||
      !isset($_POST['titulo']) ||
      !isset($_POST['anio']) ||
      !isset($_POST['sinopsis']) ||
      !isset($_POST['autor'])
    ) {
      $msj = "Complete los campos por favor.";
      $this->errorView->mostrarError($msj);
      die();
    }

    if (!is_numeric($_POST['anio'])) {
      $msj = "Año invalido!.";
      $this->errorView->mostrarError($msj);
      die();
    }

    $id_libro = $_POST['id_libro'];
    $titulo = ($_POST['titulo']);
    $anio = $_POST['anio'];
    $sinopsis = ($_POST['sinopsis']);
    $autor = $_POST['autor'];
    $tapa = $_POST['tapa'] ?? null;

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
