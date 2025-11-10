<?php

use Application\core\Controller;

class Foto extends Controller
{
  public function index()
  {
    $Produtos = $this->model('Produtos');
    $listarProd = $Produtos::listarTudo();

    $this->view('foto/index', [
      'produtos' => $listarProd
    ]);
  }
  public function salvar()
  {
    $produto = $_POST['txt_produto'];
    $imagem = $_FILES['txt_foto'];

    $timestamp   = date('YmdHis');
    $imagemName = $timestamp . '.jpg';
    $uploadPath = '../public/uploads/produto/' . $imagemName;
    if (move_uploaded_file($imagem['tmp_name'], $uploadPath)) {
      $Fotos = $this->model('fotos');
      $Fotos::salvar($produto, $imagemName);
    }
    $this->redirect('foto/index');
  }
  public function excluir($id)
  {
    $Compras = $this->model('Compras');
    $Compras::excluir($id);
    $this->redirect('compra/index');
  }
   public function editar()
  {
    $id = $_POST['txt_id'];
    $carrinho = $_POST['txt_carrinho'];
    $produto = $_POST['txt_produto'];
    $preco = $_POST['txt_preco'];
    $quantidade = $_POST['txt_quantidade'];
    $Compras = $this->model('Compras');

    //var_dump($_POST);
    //exit;

    $Compras::editar($id, $carrinho, $produto,$preco, $quantidade);
    $this->redirect('compra/index');
  }
}
