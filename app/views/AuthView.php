<?php
class AuthView
{
  public function mostrarForm()
  {
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/form-login.phtml";
  }
}
