<?php

use Application\core\Controller;

class Home extends Controller
{
  public function index()
  {
    $Produtos = $this->model('Produtos');
    $listarProd = $Produtos::listarTudo();


    $this->view('home/index', [
      'produtos' => $listarProd

    ]);
  }
  public function login()
  {
    $email = $_POST['txt_email'];
    $senha = $_POST['txt_senha'];

    $Usuarios = $this->model('Usuarios');
    $Usuarios::login($email, $senha);

    $this->redirect('home/index');
  }

}
 