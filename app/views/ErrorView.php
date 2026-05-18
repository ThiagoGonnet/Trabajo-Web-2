<?php

class ErrorView
{
  public function mostrarError($msj)
  {
    require_once "./app/views/templates/layouts/header.phtml";
    echo $msj;
  }
}
