<?php
 
use Application\core\Controller;

class Carrinho extends Controller
{

public function index()
    {

        $itensDoCarrinho = []; 

        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            $itensDoCarrinho = $_SESSION['carrinho'];
        }

        $this->view('carrinho/index', ['carrinhoItens' => $itensDoCarrinho]);
    }

public function finalizar()
    {
        session_start();

        if (!isset($_SESSION['usuario_logado'])) {
            $this->redirect('usuario/entrar');
            return;
        }

        if (!isset($_POST['produto_id']) || empty($_POST['produto_id'])) {
            $this->redirect('carrinho/listar');
            return;
        }

        $id_usuario = $_SESSION['usuario_logado']->id;

        $produtos_ids = $_POST['produto_id'];
        $produtos_quantidades = $_POST['produto_quantidade'];

        $Compras = $this->model('Carrinhos');

        foreach ($produtos_ids as $key => $id_produto) {
            $quantidade = $produtos_quantidades[$key];
            
            if (empty($id_produto) || empty($quantidade)) {
                continue;
            }
            
            $Compras::finalizar($id_usuario, $id_produto, $quantidade);
        }

        unset($_SESSION['carrinho']);

        $this->redirect('compra/sucesso');
    }

    public function sucesso()
    {
        $this->view('compra/sucesso'); 
    }


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
