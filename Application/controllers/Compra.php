<?php

use Application\core\Controller;

class Compra extends Controller
{
  public function index()
  {
    $Produtos = $this->model('Produtos');
    $listarProd = $Produtos::listarTudo();

    $Compras = $this->model('Compras');
    $listarCom = $Compras::listarTudo();
    
    $Carrinhos = $this->model('Carrinhos');
    $listarCar = $Carrinhos::listarTudo();


    $this->view('compra/index', [
      'produtos' => $listarProd,
      'compras' => $listarCom, 
      'carrinhos' => $listarCar

    ]);
  }
  public function salvar()
  {
    $carrinho = $_POST['txt_carrinho'];
    $produto = $_POST['txt_produto'];
    $quantidade = $_POST['txt_quantidade'];

    $Compras = $this->model('Compras');
    $Compras::salvar($carrinho, $produto, $preco, $quantidade);

    $this->redirect('compra/index');
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
