<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Fotos
{
  public static function salvar($produto, $foto)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'INSERT INTO tb_fotos 
        (id_produto, foto) 
        VALUES (:PRODUTO, :FOTO)',
        array(
          ':PRODUTO' => $produto,
          ':FOTO' => $foto
          )                                                           
    );
    return $result->rowCount();
  }
  public static function listarTudo($id_produto)
  {
      $conn = new Database();
      $result = $conn->executeQuery('SELECT * FROM tb_fotos WHERE id_produto = :ID_PRODUTO', array(':ID_PRODUTO' => $id_produto));
      return $result->fetchAll(PDO::FETCH_ASSOC);
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
