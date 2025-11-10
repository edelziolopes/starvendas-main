<?php

use Application\core\Controller;

class Usuario extends Controller
{
  public function index()
  {
    $Usuarios = $this->model('Usuarios');
    $data = $Usuarios::listarTudo();
    $this->view('usuario/index', ['usuarios' => $data]);
  }
  public function salvar()
  {
    $nome = $_POST['txt_nome'];
    $email = $_POST['txt_email'];
    $senha = $_POST['txt_senha'];
    $foto = $_FILES['txt_foto'];
    $tipo = $_POST['txt_tipo'];
    $endereco = $_POST['txt_endereco'];

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $timestamp = date('YmdHis');
    $fotoName = $timestamp . '.jpg';
    $uploadPath = '../public/uploads/foto/' . $fotoName;
     if (move_uploaded_file($foto['tmp_name'], $uploadPath)) {
      $usuarios = $this->model('Usuarios');
      $usuarios::salvar($nome, $email, $senhaHash, $fotoName, $tipo, $endereco);
      $this->redirect('usuario/index');
    }
  }
## ✨ Função `salvar_alteracao()` Sem Comentários

public function salvar_alteracao()
  {
      $id = $_POST['txt_id'] ?? null;
      $nome = $_POST['txt_nome'] ?? null;
      $email = $_POST['txt_email'] ?? null;
      $senha = $_POST['txt_senha'] ?? null;
      $foto = $_FILES['txt_foto'] ?? null; 

      $senhaHash = !empty($senha) ? password_hash($senha, PASSWORD_DEFAULT) : null;

      $fotoName = null;
      $uploadSucesso = false;

      if ($foto && $foto['error'] === UPLOAD_ERR_OK) {
          $timestamp = date('YmdHis');
          $fotoName = $timestamp . '.jpg';
          $uploadPath = '../public/uploads/foto/' . $fotoName;

          if (move_uploaded_file($foto['tmp_name'], $uploadPath)) {
              $uploadSucesso = true;
          }
      }

      try {
          $usuarios = $this->model('Usuarios');
          $usuarios::salvar_alteracao($id, $nome, $email, $senhaHash, $fotoName);
          
          $this->redirect('usuario/index');

      } catch (\Exception $e) {
          $this->redirect('usuario/index');
      }
  }

  public function cadastrar()
  {
    $nome = $_POST['txt_nome'];
    $email = $_POST['txt_email'];
    $senha = $_POST['txt_senha'];
    $foto = $_FILES['txt_foto'];

    //print_r($nome . ' ' . $email . ' ' . $senha . ' ' . $foto['name'] . ' ' . $endereco);exit();

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $timestamp = date('YmdHis');
    $fotoName = $timestamp . '.jpg';
    $uploadPath = '../public/uploads/foto/' . $fotoName;
     if (move_uploaded_file($foto['tmp_name'], $uploadPath)) {
      $usuarios = $this->model('Usuarios');
      $usuarios::salvar($nome, $email, $senhaHash, $fotoName);
      $this->redirect('usuario/entrar');
    }
  }
    public function cadastro()
    {
      $this->view('usuario/cadastro');
    }
    public function perfil($id)
    {
      $Usuarios = $this->model('Usuarios');
      $data = $Usuarios::listarPerfil($id);
      //print_r($data); exit();
      $this->view('usuario/perfil', ['usuario' => $data]);
    }
    
    public function creditos($id)
    {
      $Usuarios = $this->model('Usuarios');
      $data = $Usuarios::listarCreditos($id);
      //print_r($data); exit();
      $this->view('usuario/creditos', ['creditos' => $data]);
    }


  public function excluir($id)
  {
    $Usuarios = $this->model('Usuarios');
    $Usuarios::excluir($id);
    $this->redirect('usuario/index');
  }
  public function entrar()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['txt_email'];
        $senha = $_POST['txt_senha'];

        $Usuarios = $this->model('Usuarios');
        $usuario = $Usuarios::buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario->senha)) {
            session_start();
            $_SESSION['usuario_logado'] = $usuario;
            $this->redirect('/home');
        } else {
            $this->view('usuario/entrar', ['erro' => 'Email ou senha inválidos.']);
        }
    } else {
        $this->view('usuario/entrar');
    }
} 


    public function sair()
  {
      session_start();
      session_unset();
      session_destroy();
      $this->redirect('/home');
  }
  public function editar()
  {
      // 1. Coleta dos dados do formulário
      $id = $_POST['txt_id'];
      $nome = $_POST['txt_nome'];
      $email = $_POST['txt_email'];
      $senha = $_POST['txt_senha'];
      
      $fotoName = null;
      $fotoOk = false;

      // 2. Processamento da foto (se enviada)
      if (isset($_FILES['txt_foto']) && $_FILES['txt_foto']['error'] === UPLOAD_ERR_OK) {
          $foto = $_FILES['txt_foto'];
          $fotoOk = true;
          
          // Gera um nome único para o arquivo para evitar sobreposições
          $timestamp = date('YmdHis');
          $fotoName = $timestamp . '_' . basename($foto['name']); // Adicionado basename para segurança
          $uploadPath = '../public/uploads/foto/' . $fotoName;
          
          move_uploaded_file($foto['tmp_name'], $uploadPath);
      }

      // 3. Processamento da senha (se preenchida)
      // Se a senha estiver vazia, $senhaHash será null.
      $senhaHash = !empty($senha) ? password_hash($senha, PASSWORD_DEFAULT) : null;

      // 4. Chamada ao Model para executar a atualização no banco de dados
      $Usuarios = $this->model('Usuarios');
      $Usuarios::editar($id, $fotoName, $nome, $email, $senhaHash, $fotoOk, $endereco); 

      // 5. Atualização dos dados da sessão do usuário logado
      // Apenas atualiza a foto na sessão se uma nova foi enviada
      if ($fotoOk) {
          // Se houver uma foto antiga, você pode querer deletá-la aqui
          // unlink('../public/uploads/foto/' . $_SESSION['usuario_logado']->foto);
          $_SESSION['usuario_logado']->foto = $fotoName;
      }
      $_SESSION['usuario_logado']->nome = $nome;
      $_SESSION['usuario_logado']->email = $email;

      // 6. Redirecionamento com mensagem de sucesso
      $this->redirect('usuario/index');
  }
  public function editar_perfil()
  {
      // 1. Coleta dos dados do formulário
      $id = $_POST['txt_id'];
      $nome = $_POST['txt_nome'];
      $email = $_POST['txt_email'];
      $senha = $_POST['txt_senha'];
      
      $fotoName = null;
      $fotoOk = false;

      // 2. Processamento da foto (se enviada)
      if (isset($_FILES['txt_foto']) && $_FILES['txt_foto']['error'] === UPLOAD_ERR_OK) {
          $foto = $_FILES['txt_foto'];
          $fotoOk = true;
          
          // Gera um nome único para o arquivo para evitar sobreposições
          $timestamp = date('YmdHis');
          $fotoName = $timestamp . '_' . basename($foto['name']); // Adicionado basename para segurança
          $uploadPath = '../public/uploads/foto/' . $fotoName;
          
          move_uploaded_file($foto['tmp_name'], $uploadPath);
      }

      // 3. Processamento da senha (se preenchida)
      // Se a senha estiver vazia, $senhaHash será null.
      $senhaHash = !empty($senha) ? password_hash($senha, PASSWORD_DEFAULT) : null;

      // 4. Chamada ao Model para executar a atualização no banco de dados
      $Usuarios = $this->model('Usuarios');
      $Usuarios::editar($id, $fotoName, $nome, $email, $senhaHash, $fotoOk); 

      // 5. Atualização dos dados da sessão do usuário logado
      // Apenas atualiza a foto na sessão se uma nova foi enviada
      if ($fotoOk) {
          // Se houver uma foto antiga, você pode querer deletá-la aqui
          // unlink('../public/uploads/foto/' . $_SESSION['usuario_logado']->foto);
          $_SESSION['usuario_logado']->foto = $fotoName;
      }
      $_SESSION['usuario_logado']->nome = $nome;
      $_SESSION['usuario_logado']->email = $email;

      // 6. Redirecionamento com mensagem de sucesso
      $this->redirect('usuario/perfil/' . $id . '?msg=Perfil atualizado com sucesso.');
  }

  
}
