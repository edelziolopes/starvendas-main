<?php
// --- SIMULAÇÃO DE DADOS (Para renderização em ambiente estático) ---
// Em um ambiente de produção PHP, estas variáveis viriam do seu controlador.
if (!isset($data['usuario'])) {
    $data['usuario'] = [
        [
            'id' => 101,
            'nome' => 'Usuário Exemplo',
            'email' => 'exemplo@projeto.com',
            'tipo' => 'Administrador',
            'foto' => 'avatar_default.jpg', // Simula um caminho de arquivo
        ]
    ];
}

// Simula a variável de mensagem de sucesso (msg)
// Descomente a linha abaixo para testar a exibição da mensagem
// $_GET['msg'] = 'Perfil atualizado com sucesso!'; 
// -------------------------------------------------------------------

// Define o caminho base da imagem (simulação)
$base_image_path = '/uploads/foto/';
$user_photo = $data['usuario'][0]['foto'] ?? 'default.png';
$image_url = $base_image_path . $user_photo;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Tailwind Configuration: Defining Custom Colors/Styles -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        // Cores personalizadas consistentes com o Canvas de Cadastro
                        'primary-purple': '#9c27b0', // Cor principal do botão
                        'primary-hover': '#2196f3',  // Cor de hover do botão
                        'text-purple': '#5a2e91',   // Cor do título
                        'card-bg': '#f8faff',        // Fundo do card
                        'badge-bg': '#e0d3f2',       // Fundo do badge (similar ao .bg-secondary)
                        'badge-text': '#5a2e91',     // Texto do badge
                    },
                }
            }
        }
    </script>
    <style>
        /* Gradiente de fundo do body, replicando o estilo original */
        body {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e0d3f2, #f0e6ff);
            min-height: 100vh;
        }
    </style>
</head>
<!-- Centralização vertical e horizontal -->
<body class="font-sans flex items-center justify-center min-h-screen px-4 py-8">

<!-- Container centralizado com largura máxima (600px no original, aqui max-w-xl) -->
<div class="w-full max-w-xl mx-auto">
    
    <?php if (!empty($data['usuario'])): ?>
    
    <!-- Card principal, replicando .card e .shadow -->
    <div class="bg-card-bg rounded-xl shadow-2xl w-full transition duration-300">
        
        <form action="/usuario/editar_perfil" method="post" enctype="multipart/form-data">
            
            <!-- Card Body: Informações e Campos -->
            <div class="p-6 text-center">
                <input type="hidden" name="txt_id" value="<?= htmlspecialchars($data['usuario'][0]['id']) ?>">
                
                <!-- Foto de Perfil -->
                <img src="<?= $image_url ?>" 
                     alt="Foto de Perfil"
                     class="rounded-full mb-4 shadow-lg w-32 h-32 object-cover mx-auto ring-4 ring-primary-purple/50">
                     
                <!-- Nome do Usuário -->
                <h2 class="text-3xl font-extrabold mb-1 text-text-purple">
                    <?= htmlspecialchars($data['usuario'][0]['nome']) ?>
                </h2>
                
                <!-- Tipo de Usuário (Badge) -->
                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full 
                            bg-badge-bg text-badge-text mb-6 uppercase tracking-wider">
                    <?php if($data['usuario'][0]['tipo']!= 1){ echo 'Usuário Padrão'; } else { echo 'Administrador'; }  ?>
                </span>
                
                <!-- Campos de Edição -->
                <div class="space-y-4 text-left">
                    
                    <!-- Campo Foto (File Input) -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-camera mr-2"></i> Alterar Foto
                        </label>
                        <input type="file" id="foto" name="txt_foto" accept="image/*"
                               class="w-full block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                     file:rounded-full file:border-0 file:text-sm file:font-semibold
                                     file:bg-primary-purple file:text-white hover:file:bg-primary-hover
                                     border border-gray-300 rounded-lg cursor-pointer">
                    </div>
                    
                    <!-- Campo Nome -->
                    <div>
                        <label for="edit-nome" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-2"></i> Nome Completo
                        </label>
                        <input type="text" id="edit-nome" name="txt_nome" placeholder="Novo nome"
                               class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" 
                               value="<?= htmlspecialchars($data['usuario'][0]['nome']) ?>">
                    </div>
                    
                    <!-- Campo E-mail -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-envelope mr-2"></i> E-mail
                        </label>
                        <input type="email" id="email" name="txt_email" required
                               class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" 
                               value="<?= htmlspecialchars($data['usuario'][0]['email']) ?>">
                    </div>
                    
                    <!-- Campo Senha -->
                    <div>
                        <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-lock mr-2"></i> Nova Senha (Opcional)
                        </label>
                        <input type="password" id="senha" name="txt_senha" placeholder="Deixe vazio para manter a senha atual"
                               class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150">
                    </div>
                </div>

            </div>
            
            <!-- Card Footer: Botão Salvar -->
            <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-end rounded-b-xl">
                <button type="submit" 
                        class="px-6 py-2 bg-primary-purple text-white font-bold rounded-lg shadow-lg 
                               hover:bg-primary-hover transition duration-150 focus:ring-4 focus:ring-purple-300 text-base">
                    <i class="fas fa-save mr-2"></i> Salvar Alterações
                </button>
            </div>
            
        </form>

        <!-- Mensagem de Sucesso (Replica .alert .alert-success) -->
        <?php if (isset($_GET['msg'])): ?>
            <div class="p-4 m-6 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm" role="alert">
                <p><i class="fas fa-check-circle mr-2"></i> <?= htmlspecialchars($_GET['msg']) ?></p>
            </div>
        <?php endif; ?>
        
    </div>
    
    <?php else: ?>
        <!-- Mensagem de erro caso o usuário não seja encontrado -->
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm" role="alert">
            <p class="font-bold">Erro!</p>
            <p>Os dados do usuário não puderam ser carregados.</p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
