<?php

use Application\core\Controller;

class Produto extends Controller
{
  public function index()
  {
    $Categorias = $this->model('Categorias');
    $listarCat = $Categorias::listarTudo();

    $Produtos = $this->model('Produtos');
    $listarProd = $Produtos::listarTudo();


    $this->view('produto/index', [
      'categorias' => $listarCat,
      'produtos' => $listarProd,

    ]);
  }
  public function salvar()
  {
    $categoria = $_POST['txt_categoria'];
    $nome = $_POST['txt_nome'];
    $preco = $_POST['txt_preco'];
    $quantidade = $_POST['txt_quantidade'];
    $descricao = $_POST['txt_descricao'];
    $imagem = $_FILES['txt_imagem'];

    $timestamp = date('YmdHis');
    $imagemName = $timestamp . '.jpg';
    $uploadPath = '../public/uploads/produto/' . $imagemName;
    if (move_uploaded_file($imagem['tmp_name'], $uploadPath)) {
      $Produtos = $this->model('Produtos');
      $Produtos::salvar($categoria, $nome, $preco, $imagemName, $quantidade, $descricao);
    }
    $this->redirect('produto/index');
  }

    public function excluir($id)
  {
    $Produtos = $this->model('Produtos');
    $Produtos::excluir($id);
    $this->redirect('produto/index');
  }
   public function detalhes($id)
  {
    $Produtos = $this->model('Produtos');
    $Produtos::detalhes($id);
    
    $Fotos = $this->model('Fotos');
    $Fotos::listarTudo($id);

    $this->view('produto/detalhes', [
      'produto' => $Produtos::detalhes($id),
      'fotos' => $Fotos::listarTudo($id)
    ]);
  }
   public function editar()
  {
      $id = $_POST['txt_id'];
      $id_categoria = $_POST['txt_categoria'];
      $nome = $_POST['txt_nome'];
      $descricao = $_POST['txt_descricao'];
      $preco = $_POST['txt_preco'];
      $quantidade = $_POST['txt_quantidade'];
      
      $nome_imagem = null;

      if (isset($_FILES['txt_imagem']) && $_FILES['txt_imagem']['error'] == UPLOAD_ERR_OK) {
          $imagem_temp = $_FILES['txt_imagem']['tmp_name'];
          $nome_imagem = uniqid() . '-' . basename($_FILES['txt_imagem']['name']);
          $caminho_destino = 'uploads/produto/' . $nome_imagem;

          if (!move_uploaded_file($imagem_temp, $caminho_destino)) {
              $nome_imagem = null;
          }
      }

      $Produtos = $this->model('Produtos');
      $Produtos::editar($id, $id_categoria, $nome, $descricao, $preco, $quantidade, $nome_imagem);
      
      $this->redirect('produto/index');
  }  
  public static function buscarPorId($id)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'SELECT * FROM tb_produtos WHERE id = :ID',
            [':ID' => $id]
        );
        
        // Retorna como array associativo
        return $result->fetch(PDO::FETCH_ASSOC); 
    }

    /**
     * Novo método: Subtrai a quantidade do estoque.
     */
    public static function abaterEstoque($id_produto, $quantidade_comprada)
    {
        $conn = new Database();
        $result = $conn->executeQuery(
            'UPDATE tb_produtos 
             SET quantidade = quantidade - :QTD
             WHERE id = :ID',
            array(
                ':QTD' => $quantidade_comprada,
                ':ID' => $id_produto
            )
        );
        return $result->rowCount();
    }

}
