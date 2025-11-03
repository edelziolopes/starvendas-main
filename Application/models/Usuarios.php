<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Usuarios
{
  public static function salvar($nome, $email, $senha, $foto, $tipo = 2)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'INSERT INTO tb_usuarios (nome, email, senha, foto, tipo) 
         VALUES (:NOME, :EMAIL, :SENHA, :FOTO, :TIPO)',
        array(
          ':NOME' => $nome,
          ':EMAIL' => $email,
          ':SENHA' => $senha,
          ':FOTO' => $foto,
          ':TIPO' => $tipo,
        )
    );
    return $result->rowCount();
  }
// Na classe Usuarios (seu Model)
public static function salvar_alteracao($id, $nome, $email, $senhaHash, $fotoName)
{
    $fields = [];
    $params = [':ID' => $id];

    if (!empty($nome)) {
        $fields[] = 'nome = :NOME';
        $params[':NOME'] = $nome;
    }
    if (!empty($email)) {
        $fields[] = 'email = :EMAIL';
        $params[':EMAIL'] = $email;
    }
    // A senhaHash será nula ou a nova hash. Se for nula, não atualiza.
    if (!empty($senhaHash)) {
        $fields[] = 'senha = :SENHA';
        $params[':SENHA'] = $senhaHash;
    }
    // O fotoName será nulo ou o nome da nova foto. Se for nulo, não atualiza.
    if (!is_null($fotoName)) { // Usamos is_null aqui porque o nome da foto pode ser uma string vazia '' se for para remover, mas no seu caso, queremos que seja o nome do arquivo.
        $fields[] = 'foto = :FOTO';
        $params[':FOTO'] = $fotoName;
    }

    if (empty($fields)) {
        return 0; // Nada para atualizar
    }

    $sql = 'UPDATE tb_usuarios SET ' . implode(', ', $fields) . ' WHERE id = :ID';

    $conn = new Database();
    $result = $conn->executeQuery($sql, $params);
    
    return $result->rowCount();
}

  public static function excluir($id)
  {
    $conn = new Database();
    $result = $conn->executeQuery(
        'DELETE FROM tb_usuarios WHERE id=:ID',
        array(':ID' => $id)
    );
    return $result->rowCount();
  }
  public static function listarTudo()
  {
      $conn = new Database();
      $result = $conn->executeQuery('
      SELECT * FROM tb_usuarios');
      return $result->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function listarPerfil($id)
  {
      $conn = new Database();
      $result = $conn->executeQuery('
      SELECT * FROM tb_usuarios WHERE id=:ID', array(':ID' => $id));
      return $result->fetchAll(PDO::FETCH_ASSOC);
  }
  public static function buscarPorEmail($email)
  {
      $conn = new Database();
      $result = $conn->executeQuery(
          'SELECT id, nome, email, senha, foto, tipo, endereco FROM tb_usuarios WHERE email = :EMAIL',
          array(
              ':EMAIL' => $email
          )
      );
      return $result->fetch(PDO::FETCH_OBJ);
  }  
    public static function editar($id, $foto, $nome, $email, $senha, $novaFotoEnviada)
    {
        // 1. Inicia a query SQL base com os campos obrigatórios (nome e email)
        $sql = 'UPDATE tb_usuarios SET nome = :NOME, email = :EMAIL';

        // 2. Inicia o array de parâmetros com os valores obrigatórios
        $params = [
            ':NOME' => $nome,
            ':EMAIL' => $email,
            ':ID' => $id
        ];

        // 3. Adiciona a atualização da FOTO à query se uma nova imagem foi enviada
        if ($novaFotoEnviada) {
            $sql .= ', foto = :FOTO'; // Adiciona a parte da query
            $params[':FOTO'] = $foto; // Adiciona o parâmetro correspondente
        }

        // 4. Adiciona a atualização da SENHA à query se uma nova senha foi fornecida
        if (!empty($senha)) {
            $sql .= ', senha = :SENHA'; // Adiciona a parte da query
            $params[':SENHA'] = $senha; // Adiciona o parâmetro correspondente
        }

        // 5. Finaliza a query com a cláusula WHERE (sempre no final)
        $sql .= ' WHERE id = :ID';

        // 6. Executa a query
        $conn = new Database();
        $result = $conn->executeQuery($sql, $params);
        
        return $result->rowCount();
    }
}
