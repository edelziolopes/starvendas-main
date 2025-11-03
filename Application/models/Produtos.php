<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Produtos
{
  public static function buscarPorId($id)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'SELECT p.id, p.nome, p.preco, p.imagem, p.quantidade, p.descricao, c.nome AS categoria
         FROM tb_produtos p
         JOIN tb_categorias c ON p.id_categoria = c.id
         WHERE p.id = :ID',
        array(':ID' => $id)
    );
    return $result->fetch(PDO::FETCH_ASSOC);
  }

  public static function somaPrecos()
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'SELECT SUM(preco) AS soma_precos FROM tb_produtos'
    );
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['soma_precos'] ?? 0;
  }
  
  public static function salvar($categoria, $nome, $preco, $imagem, $quantidade, $descricao)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'INSERT INTO tb_produtos 
        (id_categoria, nome, preco, imagem, quantidade, descricao) 
        VALUES (:CATEGORIA, :NOME, :PRECO, :IMAGEM, :QUANTIDADE, :DESCRICAO)',
        array(
          ':CATEGORIA' => $categoria,
          ':NOME' => $nome,
          ':PRECO' => $preco,
          ':IMAGEM' => $imagem,
          ':QUANTIDADE' => $quantidade,
          ':DESCRICAO' => $descricao
          )                                                           
    );
    return $result->rowCount();
  }
  public static function excluir($id)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'DELETE FROM tb_produtos WHERE id=:ID',
        array(':ID' => $id)
    );
    return $result->rowCount();
  }
  public static function listarTudo()
  {
      $conn = new Database();
      $result = $conn->executeQuery('SELECT
      p.id, p.nome, p.preco, p.imagem,
      p.quantidade, p.descricao,
      c.nome AS categoria
      FROM tb_produtos p
      JOIN tb_categorias c
      ON p.id_categoria = c.id      
      ');
      return $result->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function detalhes($id)
  {
      $conn = new Database();
      $result = $conn->executeQuery('SELECT
      p.id, p.nome, p.preco, p.imagem,
      p.quantidade, p.descricao,
      c.nome AS categoria
      FROM tb_produtos p
      JOIN tb_categorias c
      ON p.id_categoria = c.id
      WHERE p.id = :ID',
      array(':ID' => $id)
      );
      return $result->fetch(PDO::FETCH_ASSOC);
  }
   public static function editar($id, $id_categoria, $nome, $descricao, $preco, $quantidade, $imagem)
  {
      // 1. Inicia a query SQL e o array de parâmetros
      $sql = 'UPDATE tb_produtos SET id_categoria = :ID_CATEGORIA, nome = :NOME, descricao = :DESCRICAO, preco = :PRECO, quantidade = :QUANTIDADE';
      $params = [
          ':ID_CATEGORIA' => $id_categoria,
          ':NOME' => $nome,
          ':DESCRICAO' => $descricao,
          ':PRECO' => $preco,
          ':QUANTIDADE' => $quantidade,
      ];

      // 2. Adiciona a atualização de imagem à query se uma nova imagem foi fornecida
      if ($imagem !== null) {
          $sql .= ', imagem = :IMAGEM';
          $params[':IMAGEM'] = $imagem;
      }

      // 3. Finaliza a query com a cláusula WHERE
      $sql .= ' WHERE id = :ID';
      $params[':ID'] = $id;

      // 4. Executa a query
      $conn = new Database();
      $result = $conn->executeQuery($sql, $params);
      
      return $result->rowCount();
  }

  
}
