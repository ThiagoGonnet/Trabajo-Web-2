<?php
require_once "./app/models/AuthModel.php";
require_once "./app/views/AuthView.php";
require_once "./app/views/ErrorView.php";

class AuthController
{
  private $view;
  private $model;
  private $errorView;

  public function __construct()
  {
    $this->view = new AuthView();
    $this->model = new AuthModel();
    $this->errorView = new errorView();
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
        $_SESSION['ID_USER'] = $usuarioDb->id; // Guardas el ID
        $_SESSION['USERNAME'] = $usuarioDb->usuario; // Opcional, para mostrarlo

        header('Location: home');
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
  public function cerrarSesion() {}
}
