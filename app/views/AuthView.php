<?php
class AuthView
{
  public function mostrarForm()
  {
    require_once "./app/views/templates/layouts/header.phtml";
    require_once "./app/views/templates/form-login.phtml";
  }
  public function mostrarPanelAdmin($libros, $autores)
  {
    require_once "./app/views/templates/layouts/header.phtml";
    require_once "./app/views/templates/form_agregarAutor.phtml";
    require_once "./app/views/templates/form_eliminarAutor.phtml";
    require_once "./app/views/templates/form_actualizarAutor.phtml";
    require_once "./app/views/templates/form-subir-libro.phtml";
    require_once "./app/views/templates/form-eliminar-libro.phtml";
    require_once "./app/views/templates/form-actualizar-libro.phtml";
  }
}
