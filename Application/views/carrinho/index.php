
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Carrinhos</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Estilos customizados para replicar o design original */
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
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-mid1), var(--gradient-mid2), var(--gradient-end));
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }
        
        /* Estilização para o select (melhor visual em Tailwind) */
        select.form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem 1rem;
        }
    </style>

    <script>
        // Configuração do Tailwind para cores customizadas
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-purple': '#9c27b0',
                        'primary-hover': '#2196f3',
                        'card-title': '#5a2e91',
                        'card-bg': '#f8faff',
                    }
                }
            }
        }
    </script>
</head>
<body class="p-4">

    <!-- Container Principal -->
    <div class="max-w-6xl mx-auto my-12 p-4">
        
        <!-- Cartão de Cadastro de Carrinho -->
        <div class="bg-card-bg rounded-xl shadow-2xl p-6 mb-12">
            <h2 class="text-3xl font-bold mb-6 text-center text-card-title">Cadastro de Carrinho</h2>
            
            <form action="/carrinho/salvar" method="POST">

                <!-- Campo Usuário -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-4 gap-2">
                    <label for="id_usuario" class="flex items-center w-full sm:w-32 text-sm font-medium text-gray-700">
                        <i class="fas fa-user w-4 mr-2 text-primary-purple"></i> Usuário
                    </label>
                    <select class="form-select flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150 bg-white" 
                            id="id_usuario" name="txt_usuario" required>
                        <option value="" selected disabled>Selecione o usuário</option>
                        <?php foreach ($data['usuarios'] as $dados): ?>
                            <option value="<?= $dados['id'] ?>"><?= htmlspecialchars($dados['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo Endereço -->
                <div class="flex flex-col sm:flex-row sm:items-center mb-6 gap-2">
                    <label for="id_endereco" class="flex items-center w-full sm:w-32 text-sm font-medium text-gray-700">
                        <i class="fas fa-map-marker-alt w-4 mr-2 text-primary-purple"></i> Endereço
                    </label>
                    <select class="form-select flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150 bg-white" 
                            id="id_endereco" name="txt_endereco" required>
                        <option value="" selected disabled>Selecione o endereço</option>
                        <?php foreach ($data['enderecos'] as $dados): ?>
                            <option value="<?= $dados['id'] ?>"><?= htmlspecialchars($dados['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Botões -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="/carrinho" class="px-6 py-2 rounded-xl text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-150 font-semibold shadow-sm">Cancelar</a>
                    <button type="submit" class="px-6 py-2 rounded-xl transition duration-200 font-bold shadow-md 
                                                 text-white bg-primary-purple hover:bg-primary-hover focus:ring-4 focus:ring-purple-300">
                        <i class="fas fa-save mr-2"></i> Salvar
                    </button>
                </div>

            </form>
        </div>

        <!-- Cartão de Lista de Carrinhos -->
        <div class="bg-card-bg rounded-xl shadow-2xl p-6">
            <h3 class="text-2xl font-bold mb-6 text-card-title">Lista de Carrinhos</h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-id-badge mr-1"></i> ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-user mr-1"></i> Usuário</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-map-marker-alt mr-1"></i> Endereço</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider"><i class="fas fa-cog mr-1"></i> Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($data['carrinhos'] as $dados): ?>
                        <tr class="hover:bg-indigo-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($dados['id']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($dados['usuario']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($dados['endereco']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                <!-- O botão de editar passa todos os IDs necessários para preencher o modal -->
                                <button onclick="openEditModal(
                                    <?= htmlspecialchars($dados['id']) ?>, 
                                    <?= htmlspecialchars($dados['id_usuario']) ?>, 
                                    <?= htmlspecialchars($dados['id_endereco']) ?>
                                )" 
                                class="text-primary-purple hover:text-primary-hover font-medium px-2 py-1 rounded-lg transition duration-150">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <a href="/carrinho/excluir/<?= $dados['id'] ?>" 
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
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 hidden items-center justify-center z-50 transition-opacity duration-300" aria-modal="true" role="dialog">
        <div class="bg-white rounded-xl shadow-3xl w-full max-w-lg transform scale-95 transition-transform duration-300 overflow-hidden">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h5 class="text-xl font-bold text-card-title" id="editModalLabel">Editar Carrinho</h5>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition duration-150" onclick="closeEditModal()">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <form action="/carrinho/editar" method="POST">
                    <input type="hidden" id="edit-id" name="txt_id">
                    
                    <div class="space-y-4">
                        <!-- Usuário -->
                        <div class="mb-3">
                            <label for="edit-usuario" class="block text-sm font-medium text-gray-700 mb-1"><i class="fas fa-user mr-1 text-primary-purple"></i> Usuário</label>
                            <select class="form-select w-full p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple bg-white" 
                                    id="edit-usuario" name="txt_usuario" required>
                                <option value="" selected disabled>Selecione o usuário</option>
                                <?php foreach ($data['usuarios'] as $dados): ?>
                                    <option value="<?= $dados['id'] ?>"><?= htmlspecialchars($dados['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Endereço -->
                        <div class="mb-3">
                            <label for="edit-endereco" class="block text-sm font-medium text-gray-700 mb-1"><i class="fas fa-map-marker-alt mr-1 text-primary-purple"></i> Endereço</label>
                            <select class="form-select w-full p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple bg-white" 
                                    id="edit-endereco" name="txt_endereco" required>
                                <option value="" selected disabled>Selecione o endereço</option>
                                <?php foreach ($data['enderecos'] as $dados): ?>
                                    <option value="<?= $dados['id'] ?>"><?= htmlspecialchars($dados['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
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
        const editModal = document.getElementById('editModal');

        /**
         * Abre o modal de edição e preenche os campos com os IDs recebidos.
         * @param {number} id - ID do carrinho.
         * @param {number} idUsuario - ID do usuário.
         * @param {number} idEndereco - ID do endereço.
         */
        function openEditModal(id, idUsuario, idEndereco) {
            // Preenche os campos do formulário no modal
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-usuario').value = idUsuario;
            document.getElementById('edit-endereco').value = idEndereco;
            
            // Exibe o modal (substitui o data-bs-toggle do Bootstrap)
            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Evita rolagem no corpo
        }

        /**
         * Fecha o modal de edição.
         */
        function closeEditModal() {
            // Oculta o modal
            editModal.classList.add('hidden');
            editModal.classList.remove('flex');
            document.body.style.overflow = ''; // Restaura a rolagem
        }
    </script>

</body>
</html>
