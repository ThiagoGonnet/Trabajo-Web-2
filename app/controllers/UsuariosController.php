<?php

class UsuariosController{
  public function mostrarFormRegistro(){
    header("Location:" . BASE_URL . "login");
    die();
  }
}
