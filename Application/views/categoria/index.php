<?php
// Este arquivo é um exemplo de uma view que utiliza o array $data['categorias'].
// A injeção das variáveis e o carregamento do Tailwind CSS (CDN) 
// devem ser tratados no seu arquivo de layout principal.

// Simulação de dados para visualização, caso não estejam definidos:
if (!isset($data['categorias'])) {
    $data['categorias'] = [
        ['id' => 1, 'nome' => 'Colares'],
        ['id' => 2, 'nome' => 'Brincos'],
        ['id' => 3, 'nome' => 'Pulseiras'],
    ];
}

// Definição das cores personalizadas do CSS original:
// Card Background: #f8faff
// Card Title/Text: #5a2e91
// Primary Button: #9c27b0 (Hover: #2196f3)
// Card Footer: #e6f0ff
// Badge Background: #e0d3f2
?>

<!-- Container principal centralizado e com margem vertical -->
<div class="container mx-auto px-4 py-8">

    <!-- 1. FORMULÁRIO DE CADASTRO -->
    <div class="max-w-xl mx-auto">
        <!-- Card (bg-[#f8faff], rounded-xl, shadow-xl) -->
        <div class="bg-[#f8faff] rounded-xl shadow-xl p-6 md:p-8">
            <h2 class="text-3xl font-bold mb-6 text-center text-[#5a2e91]">Cadastro de Categorias</h2>

            <form action="/categoria/salvar" method="POST">
                <!-- Campo de Input (Equivalente a .row.align-items-center) -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center mb-6 space-y-2 sm:space-y-0 sm:space-x-4">
                    
                    <!-- Label (Equivalente a .col-auto e .col-form-label) -->
                    <label for="categoria" class="flex items-center text-lg text-gray-700 flex-shrink-0 w-full sm:w-28">
                        <i class="fas fa-tag mr-2 text-[#5a2e91]"></i> Nome
                    </label>
                    
                    <!-- Input (Equivalente a .col e .form-control) -->
                    <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#9c27b0] focus:border-[#9c27b0] outline-none transition duration-150" 
                           id="categoria" name="txt_nome" required>
                </div>
                
                <!-- Botões de Ação (Equivalente a .d-flex.justify-content-end.gap-2) -->
                <div class="flex justify-end space-x-3 mt-6">
                    <a href="/categoria" class="px-5 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition duration-150 font-medium">
                        Cancelar
                    </a>
                    <!-- Botão Primário (bg-[#9c27b0], hover:bg-[#2196f3]) -->
                    <button type="submit" class="px-5 py-2 text-white rounded-lg transition duration-200 font-semibold
                                               bg-[#9c27b0] hover:bg-[#2196f3] focus:outline-none focus:ring-4 focus:ring-purple-300">
                        <i class="fas fa-save mr-2"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. TABELA DE LISTAGEM -->
    <div class="max-w-4xl mx-auto mt-12">
        <!-- Card para Listagem -->
        <div class="bg-[#f8faff] rounded-xl shadow-xl p-6 md:p-8">
            <h3 class="text-2xl font-semibold mb-6 text-[#5a2e91]">Lista de Categorias</h3>
            
            <!-- Tabela Responsiva (Equivalente a .table-responsive) -->
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-id-badge mr-1"></i> ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-tag mr-1"></i> Nome
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-cog mr-1"></i> Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php foreach ($data['categorias'] as $dados): ?>
                        <tr class="hover:bg-gray-50 transition duration-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($dados['id']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= htmlspecialchars($dados['nome']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end space-x-2">
                                <!-- Botão Editar (Customizado para ficar discreto e funcional) -->
                                <button type="button" 
                                        class="text-blue-600 hover:text-blue-800 transition duration-150 p-2 rounded-lg hover:bg-blue-50"
                                        onclick="openEditModal(<?= htmlspecialchars($dados['id']) ?>, '<?= htmlspecialchars($dados['nome']) ?>')">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </button>
                                <!-- Botão Excluir (Estilo Primário) -->
                                <a href="/categoria/excluir/<?= htmlspecialchars($dados['id']) ?>" 
                                   class="text-white px-3 py-2 rounded-lg transition duration-200 text-sm font-semibold
                                          bg-[#9c27b0] hover:bg-[#2196f3] focus:outline-none focus:ring-4 focus:ring-purple-300">
                                    <i class="fas fa-trash-alt mr-1"></i> Excluir
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- 3. MODAL DE EDIÇÃO (Em Tailwind/JS Puro) -->
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
            <h5 class="text-xl font-semibold text-gray-800" id="editModalLabel">Editar Categoria</h5>
            <button type="button" class="text-gray-400 hover:text-gray-600 transition duration-150" onclick="closeEditModal()" aria-label="Close">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="pt-4">
            <form action="/categoria/editar" method="POST">
                <input type="hidden" id="edit-id" name="txt_id">
                <div class="mb-4">
                    <label for="edit-categoria" class="block text-sm font-medium text-gray-700 mb-2">Nome</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#9c27b0] focus:border-[#9c27b0] outline-none transition duration-150" 
                           id="edit-categoria" name="txt_nome" required>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-5 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition duration-150 font-medium" onclick="closeEditModal()">
                        Fechar
                    </button>
                    <!-- Botão Primário (bg-[#9c27b0], hover:bg-[#2196f3]) -->
                    <button type="submit" class="px-5 py-2 text-white rounded-lg transition duration-200 font-semibold
                                               bg-[#9c27b0] hover:bg-[#2196f3] focus:outline-none focus:ring-4 focus:ring-purple-300">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript para o Modal (Substituindo dependências do Bootstrap JS) -->
<script>
    // Referência aos elementos
    const editModal = document.getElementById('editModal');
    const modalContent = document.getElementById('modalContent');
    const modalIdInput = document.getElementById('edit-id');
    const modalCategoriaInput = document.getElementById('edit-categoria');

    /**
     * Abre o modal de edição e preenche os campos com os dados da categoria.
     * @param {number} id - O ID da categoria.
     * @param {string} nome - O nome atual da categoria.
     */
    function openEditModal(id, nome) {
        // 1. Preenche os campos do formulário
        modalIdInput.value = id;
        modalCategoriaInput.value = nome;

        // 2. Torna o modal visível
        editModal.classList.remove('hidden');
        editModal.classList.add('flex');

        // 3. Aplica a animação de entrada
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    /**
     * Fecha o modal de edição.
     */
    function closeEditModal() {
        // 1. Aplica a animação de saída
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        // 2. Oculta o modal após a transição
        setTimeout(() => {
            editModal.classList.remove('flex');
            editModal.classList.add('hidden');
        }, 300); // 300ms corresponde à duração da transição no Tailwind
    }

    // Fecha o modal ao clicar fora dele
    editModal.addEventListener('click', (event) => {
        if (event.target === editModal) {
            closeEditModal();
        }
    });

    // Fecha o modal ao pressionar ESC
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !editModal.classList.contains('hidden')) {
            closeEditModal();
        }
    });
</script>
