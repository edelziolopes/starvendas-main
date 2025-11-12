<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Carrinhos
{

    public static function finalizar($id_usuario, $id_produto, $quantidade)
    {
        $conn = new Database();
        
        // Query SQL corrigida para usar a tb_venda e seus campos corretos
        // O status é definido como 0 (padrão 'pendente', como no seu SQL)
        $result = $conn->executeQuery(
            'INSERT INTO tb_venda 
             (id_usuario, id_produto, quantidade, status) 
             VALUES (:ID_USUARIO, :ID_PRODUTO, :QUANTIDADE, 0)',
            array(
                ':ID_USUARIO' => $id_usuario,
                ':ID_PRODUTO' => $id_produto,
                ':QUANTIDADE' => $quantidade
            )
        );
        
        return $result->rowCount();
    }

  public static function salvar($usuario, $endereco)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'INSERT INTO tb_carrinhos 
        (id_usuario, id_endereco) 
        VALUES (:USUARIO, :ENDERECO)',
        array(
          ':USUARIO' => $usuario,
          ':ENDERECO' => $endereco,
          )                                                           
    );
    return $result->rowCount();
      }
  public static function editar($id, $usuario, $endereco)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'UPDATE tb_carrinhos
        SET id_usuario = :USUARIO, id_endereco = :ENDERECO
        WHERE id = :ID',
        array(
          ':ID' => $id,
          ':USUARIO' => $usuario,
          ':ENDERECO' => $endereco
        )
    );
    return $result->rowCount();
  }
  public static function excluir($id)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'DELETE FROM tb_carrinhos WHERE id=:ID',
        array(':ID' => $id)
    );
    return $result->rowCount();
  }
  public static function listarTudo()
  {
      $conn = new Database();
      $result = $conn->executeQuery('SELECT c.id, u.nome AS usuario, e.nome AS endereco FROM tb_carrinhos c JOIN tb_usuarios u ON u.id=id_usuario JOIN tb_enderecos e ON e.id=id_endereco;');
      return $result->fetchAll(PDO::FETCH_ASSOC);
  }

}
