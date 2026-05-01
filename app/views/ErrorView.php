<?php

class ErrorView
{
  public function mostrarError($msj)
  {
    require_once "./app/views/layouts/header.phtml";
    echo $msj;
  }
}
