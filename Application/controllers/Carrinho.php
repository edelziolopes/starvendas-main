<?php
 
use Application\core\Controller;

class Carrinho extends Controller
{

  public function remover($id)
  {
    if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
      $key = array_search($id, $_SESSION['carrinho']);
      if ($key !== false) {
        unset($_SESSION['carrinho'][$key]);
        // Reindexa o array para evitar buracos nos índices
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
      }
    }
    $this->redirect('carrinho/listar', ['msg' => 'Produto removido do carrinho']);
  }
  public function listar()
  {
    $produtos = [];
    $total = 0;
    if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
      $Produtos = $this->model('Produtos');
      foreach ($_SESSION['carrinho'] as $produtoId) {
        $produto = $Produtos::buscarPorId($produtoId);
        if ($produto) {
          $produtos[] = $produto;
          $total += isset($produto['preco']) ? $produto['preco'] : 0;
        }
      }
    }
    $this->view('carrinho/listar', [
      'produtos' => $produtos,
      'total' => $total
    ]);
  }

  public function adicionar($id)
  {
    if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
      $_SESSION['carrinho'] = [];
    }
    $_SESSION['carrinho'][] = $id;
    $this->redirect('produto/detalhes/'.$id, ['msg' => 'Produto adicionado no carrinho']);
  }

  public function index()
  {
    $Usuarios = $this->model('Usuarios');
    $listarUser = $Usuarios::listarTudo();
    
    $Carrinhos = $this->model('Carrinhos');
    $listarCar = $Carrinhos::listarTudo();

    $this->view('carrinho/index', [
      'usuarios' => $listarUser, 
      'carrinhos' => $listarCar

    ]);
  }
  public function salvar()
  {
    $usuario = $_POST['txt_usuario'];
    $endereco = $_POST['txt_endereco'];

    $Carrinhos = $this->model('Carrinhos');
    $Carrinhos::salvar($usuario, $endereco);

    $this->redirect('carrinho/index');
  }
   public function editar()
  {
    $id = $_POST['txt_id'];
    $usuario = $_POST['txt_usuario'];
    $endereco = $_POST['txt_endereco'];
    $Carrinhos = $this->model('Carrinhos');

    $Carrinhos::editar($id, $usuario, $endereco);
    $this->redirect('carrinho/index');
  }
  public function excluir($id)
  {
    $Carrinhos = $this->model('Carrinhos');
    $Carrinhos::excluir($id);
    $this->redirect('carrinho/index');
  }
}
