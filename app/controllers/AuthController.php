<?php
require_once "./app/models/AuthModel.php";
require_once "./app/views/AuthView.php";
require_once "./app/views/ErrorView.php";
require_once "./app/models/AutoresModel.php";
require_once "./app/models/LibrosModel.php";

class AuthController
{
  private $view;
  private $model;
  private $errorView;
  private $LibrosModel;
  private $AutoresModel;

  public function __construct()
  {
    $this->view = new AuthView();
    $this->model = new AuthModel();
    $this->errorView = new errorView();
    $this->LibrosModel = new LibrosModel;
    $this->AutoresModel = new AutoresModel;
  }
  public function usuarioLogueado()
  {
    if (!isset($_SESSION['ID_USER'])) {
      return header('Location: ' . BASE_URL . 'login');
      die();
    }
  }
  public function mostrarLogin()
  {
    return $this->view->mostrarForm();
  }
  public function iniciarSesion()
  {
    if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {
      $usuario = $_POST['usuario'];
      $contraseña = $_POST['contraseña'];
      $usuarioDb = $this->model->obtenerUsuario($usuario);
      if ($usuarioDb && password_verify($contraseña, $usuarioDb->contraseña)) {
        session_start();
        $_SESSION['ID_USER'] = $usuarioDb->id;
        $_SESSION['USERNAME'] = $usuarioDb->usuario;

        header('Location: home-admin');
        die();
      } else {
        $this->errorView->mostrarError("Los datos son incorrectos!");
        die();
      }
    } else {
      $msj = "Complete los campos por favor!";
      $this->errorView->mostrarError($msj);
      die();
    }
  }
  public function mostrarHomeAdmin()
  {
    //session_start();
    $this->usuarioLogueado();
    $libros = $this->LibrosModel->obtenerLibros();
    $autores = $this->AutoresModel->obtenerAutores();

    $this->view->mostrarPanelAdmin($libros, $autores);
  }
  public function cerrarSesion()
  {
    session_start();
    session_destroy();
    header('Location: home');
  }
}
