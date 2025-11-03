<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Compras
{
  public static function salvar($carrinho, $produto, $preco, $quantidade)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'INSERT INTO tb_compras 
        (id_carrinho, id_produto, preco, quantidade) 
        VALUES (:CARRINHO, :PRODUTO, :PRECO, :QUANTIDADE)',
        array(
          ':CARRINHO' => $carrinho,
          ':PRODUTO' => $produto,
          ':PRECO' => $preco,
          ':QUANTIDADE' => $quantidade
          )                                                           
    );
    return $result->rowCount();
  }
  public static function excluir($id)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'DELETE FROM tb_compras WHERE id=:ID',
        array(':ID' => $id)
    );
    return $result->rowCount();
  }
  public static function listarTudo()
  {
      $conn = new Database();
      $result = $conn->executeQuery('SELECT c.id, u.nome, p.nome as produto, c.quantidade FROM tb_compras c JOIN tb_usuarios u ON c.id=c.id JOIN tb_produtos p ON p.id=c.id_produto;');
      return $result->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function editar($id,$carrinho, $produto, $preco, $quantidade)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'UPDATE tb_compras
        SET id_carrinho = :CARRINHO,
            id_produto = :PRODUTO,
            preco = :PRECO,
            quantidade = :QUANTIDADE
        WHERE id = :ID',
        array(
            ':CARRINHO' => $carrinho,
            ':PRODUTO' => $produto,
            ':PRECO' => $preco,
            ':QUANTIDADE' => $quantidade,
        )
    );
    return $result->rowCount();
        'UPDATE tb_compras
        SET id_carrinho = :CARRINHO,
            id_produto = :PRODUTO,
            preco = :PRECO,
            quantidade = :QUANTIDADE
        WHERE id = :ID';
        $params = array(
            ':ID' => $id,
            ':CARRINHO' => $carrinho,
            ':PRODUTO' => $produto,
            ':PRECO' => $preco,
            ':QUANTIDADE' => $quantidade,
        );
    return $result->rowCount();
  }
  

}
