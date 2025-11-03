<?php
// --- SIMULAÇÃO DE DADOS PHP ---
// Em um ambiente real, estes dados viriam do seu banco de dados.

// 1. Simulação de Lista de Usuários
if (!isset($data['usuarios'])) {
    $data['usuarios'] = [
        [
            'id' => 1, 
            'nome' => 'Alice Admin', 
            'email' => 'alice@admin.com', 
            'foto' => 'alice.jpg', 
            'tipo' => 1, // Administrador
            'senha' => 'hidden' // Senha não deve ser exposta
        ],
        [
            'id' => 2, 
            'nome' => 'Bruno Comum', 
            'email' => 'bruno@user.com', 
            'foto' => 'bruno.jpg', 
            'tipo' => 2, // Usuário Comum
            'senha' => 'hidden'
        ],
    ];
}

// 2. Simulação de caminho de upload de fotos (usado na tabela)
$upload_path = '../uploads/foto/';
// ----------------------------
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Estilos baseados no CSS original */
        :root {
            --color-title: #5a2e91;
            --color-primary: #9c27b0;
            --color-primary-hover: #2196f3;
            --color-card-bg: #f8faff;
            --gradient-start: #e3f2fd;
            --gradient-mid1: #bbdefb;
            --gradient-mid2: #e0d3f2;
            --gradient-end: #f0e6ff;
        }
        
        body {
            /* Mimics the original linear-gradient background */
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-mid1), var(--gradient-mid2), var(--gradient-end));
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }
        /* Estilização básica para o select (melhor visual em Tailwind) */
        select.form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem 1rem;
        }
    </style>

    <script>
        // Configuração do Tailwind para mapear cores customizadas
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-purple': '#9c27b0',     /* btn-primary */
                        'primary-hover': '#2196f3',      /* btn-primary:hover */
                        'card-title': '#5a2e91',         /* card-title */
                        'card-bg': '#f8faff',            /* card background */
                    }
                }
            }
        }
    </script>
</head>
<body class="p-4">

    <!-- Container Principal -->
    <div class="max-w-6xl mx-auto my-12 p-4">
        
        <!-- Cartão de Cadastro de Usuários -->
        <div class="bg-card-bg rounded-xl shadow-2xl p-6 mb-12">
            <h2 class="text-3xl font-bold mb-6 text-center text-card-title">Cadastro de Usuários</h2>
            
            <form action="/usuario/salvar" method="POST" enctype="multipart/form-data">

                <!-- Campo Nome -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-4 gap-2">
                    <label for="nome" class="flex items-center w-full sm:w-32 text-sm font-medium text-gray-700">
                        <i class="fas fa-user w-4 mr-2 text-primary-purple"></i> Nome
                    </label>
                    <input type="text" class="form-input flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" id="nome" name="txt_nome" required>
                </div>

                <!-- Campo Email -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-4 gap-2">
                    <label for="email" class="flex items-center w-full sm:w-32 text-sm font-medium text-gray-700">
                        <i class="fas fa-envelope w-4 mr-2 text-primary-purple"></i> Email
                    </label>
                    <input type="email" class="form-input flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" id="email" name="txt_email" required>
                </div>

                <!-- Campo Senha -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-4 gap-2">
                    <label for="senha" class="flex items-center w-full sm:w-32 text-sm font-medium text-gray-700">
                        <i class="fas fa-lock w-4 mr-2 text-primary-purple"></i> Senha
                    </label>
                    <input type="password" class="form-input flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" id="senha" name="txt_senha" required>
                </div>

                <!-- Campo Foto e Tipo -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-6 gap-4">
                    
                    <!-- Foto -->
                    <div class="flex flex-col sm:flex-row sm:items-center w-full sm:w-1/2 gap-2">
                        <label for="foto" class="flex items-center w-full sm:w-32 text-sm font-medium text-gray-700">
                            <i class="fas fa-image w-4 mr-2 text-primary-purple"></i> Foto
                        </label>
                        <input type="file" class="form-input flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150 text-gray-700" id="foto" name="txt_foto" required>
                    </div>
                    
                    <!-- Tipo -->
                    <div class="flex flex-col sm:flex-row sm:items-center w-full sm:w-1/2 gap-2">
                        <label for="tipo" class="flex items-center w-full sm:w-32 text-sm font-medium text-gray-700">
                            <i class="fas fa-id-card w-4 mr-2 text-primary-purple"></i> Tipo
                        </label>
                        <select name="txt_tipo" id="tipo" class="form-select flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150 bg-white">
                            <option value="1">Administrador</option>
                            <option value="2">Usuário Comum</option>
                        </select>
                    </div>
                </div>

                <!-- Botões -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="/usuario" class="px-6 py-2 rounded-xl text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-150 font-semibold shadow-sm">Cancelar</a>
                    <button type="submit" class="px-6 py-2 rounded-xl transition duration-200 font-bold shadow-md 
                                                 text-white bg-primary-purple hover:bg-primary-hover focus:ring-4 focus:ring-purple-300">
                        <i class="fas fa-save mr-2"></i> Salvar
                    </button>
                </div>

            </form>
        </div>

        <!-- Cartão de Lista de Usuários -->
        <div class="bg-card-bg rounded-xl shadow-2xl p-6">
            <h3 class="text-2xl font-bold mb-6 text-card-title">Lista de Usuários</h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-id-badge mr-1"></i> ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-user mr-1"></i> Nome</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-envelope mr-1"></i> Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-image mr-1"></i> Foto</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-id-card-alt mr-1"></i> Tipo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-cog mr-1"></i> Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($data['usuarios'] as $dados): ?>
                        <tr class="hover:bg-indigo-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($dados['id']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($dados['nome']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($dados['email']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="<?= $upload_path . htmlspecialchars($dados['foto']) ?>" alt="Foto" 
                                     class="w-10 h-10 rounded-full object-cover shadow-sm">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php if($dados['tipo'] == 1): ?> <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Administrador</span> 
                                <?php else: ?> <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Usuário Comum</span> <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="openEditModal(<?= htmlspecialchars(json_encode($dados)) ?>)" 
                                        class="text-primary-purple hover:text-primary-hover font-medium px-2 py-1 rounded-lg transition duration-150">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <a href="/usuario/excluir/<?= $dados['id'] ?>" 
                                   class="text-red-600 hover:text-red-800 font-medium px-2 py-1 rounded-lg transition duration-150">
                                    <i class="fas fa-trash-alt"></i> Excluir
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL DE EDIÇÃO CUSTOMIZADO (Tailwind/JS) -->
    <div id="editUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 hidden items-center justify-center z-50 transition-opacity duration-300" aria-modal="true" role="dialog">
        <div class="bg-white rounded-xl shadow-3xl w-full max-w-2xl transform scale-95 transition-transform duration-300 overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h5 class="text-xl font-bold text-card-title" id="editProductModalLabel">Editar Usuário</h5>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition duration-150" onclick="closeEditModal()">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <form action="/usuario/salvar_alteracao" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit-id" name="txt_id">
                    
                    <div class="space-y-4">
                        <!-- Nome -->
                        <div>
                            <label for="edit-nome" class="block text-sm font-medium text-gray-700 mb-1"><i class="fas fa-tag mr-1 text-primary-purple"></i> Nome</label>
                            <input type="text" class="form-input w-full p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple" id="edit-nome" name="txt_nome" required>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="edit-email" class="block text-sm font-medium text-gray-700 mb-1"><i class="fas fa-envelope mr-1 text-primary-purple"></i> Email</label>
                            <input type="email" class="form-input w-full p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple" id="edit-email" name="txt_email" required>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Senha -->
                            <div>
                                <label for="edit-senha" class="block text-sm font-medium text-gray-700 mb-1"><i class="fas fa-lock mr-1 text-primary-purple"></i> Nova Senha (Opcional)</label>
                                <input type="password" id="edit-senha" name="txt_senha" class="form-input w-full p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple">
                            </div>
                        </div>

                        <!-- Foto -->
                        <div>
                            <label for="edit-foto-file" class="block text-sm font-medium text-gray-700 mb-1"><i class="fas fa-image mr-1 text-primary-purple"></i> Foto</label>
                            <div class="flex items-center space-x-4">
                                <img id="current-user-image" src="" alt="Foto Atual" class="w-16 h-16 rounded-full object-cover shadow-md border-2 border-gray-200">
                                <input type="file" class="form-input flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple text-gray-700" id="edit-foto-file" name="txt_foto">
                            </div>
                            <small class="text-xs text-gray-500">Deixe em branco para manter a foto atual.</small>
                        </div>
                        
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="flex justify-end gap-3 pt-6 mt-6 border-t border-gray-200">
                        <button type="button" class="px-6 py-2 rounded-xl text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-150 font-semibold shadow-sm" onclick="closeEditModal()">Cancelar</button>
                        <button type="submit" class="px-6 py-2 rounded-xl transition duration-200 font-bold shadow-md 
                                                     text-white bg-primary-purple hover:bg-primary-hover focus:ring-4 focus:ring-purple-300">
                            <i class="fas fa-save mr-2"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const editUserModal = document.getElementById('editUserModal');
        const uploadPath = '<?= $upload_path ?>';

        function openEditModal(userData) {
            // Preenche os campos do formulário
            document.getElementById('edit-id').value = userData.id;
            document.getElementById('edit-nome').value = userData.nome;
            document.getElementById('edit-email').value = userData.email;
            document.getElementById('edit-senha').value = ''; // Limpa a senha para nova entrada
            
            // Atualiza a imagem atual no modal
            const userImageElement = document.getElementById('current-user-image');
            if (userData.foto) {
                userImageElement.src = uploadPath + userData.foto;
            } else {
                userImageElement.src = 'https://placehold.co/64x64/cccccc/333333?text=N/A';
            }
            
            // Exibe o modal
            editUserModal.classList.remove('hidden');
            editUserModal.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Evita rolagem no corpo
        }

        function closeEditModal() {
            // Oculta o modal
            editUserModal.classList.add('hidden');
            editUserModal.classList.remove('flex');
            document.body.style.overflow = ''; // Restaura a rolagem
        }
    </script>

</body>
</html>
