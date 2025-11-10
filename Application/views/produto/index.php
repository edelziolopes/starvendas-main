

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Variáveis e Estilos Customizados do código original */
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
            /* Mimics the linear-gradient(135deg, #e3f2fd, #bbdefb, #e0d3f2, #f0e6ff) */
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-mid1), var(--gradient-mid2), var(--gradient-end));
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        /* --- Estilos do Carrossel --- */
        .carousel-container {
            overflow-x: scroll; 
            scroll-snap-type: x mandatory; 
            -webkit-overflow-scrolling: touch; 
            scrollbar-width: none; 
        }

        .carousel-container::-webkit-scrollbar {
            display: none; 
        }

        .carousel-item {
            scroll-snap-align: center; 
            flex-shrink: 0; 
        }
    </style>

    <script>
        // Configuração do Tailwind para usar as cores customizadas
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-purple': '#9c27b0', // Original btn-primary
                        'primary-hover': '#2196f3',  // Original btn-primary:hover
                        'card-title': '#5a2e91',     // Original card-title
                        'card-bg': '#f8faff',        // Original card background
                        'secondary-bg': '#e6f0ff',   // Original card-footer background
                    }
                }
            }
        }
    </script>
</head>
<body class="p-4 md:p-8">

<div class="max-w-7xl mx-auto py-8 space-y-12">

    <!-- 1. FORMULÁRIO DE CADASTRO DE PRODUTOS -->
    <div class="max-w-4xl mx-auto">
        <!-- Card (bg-[#f8faff], rounded-xl, shadow-xl) -->
        <div class="bg-card-bg rounded-xl shadow-xl p-6 md:p-10 transition duration-300">
            <h2 class="text-3xl font-bold mb-8 text-center text-card-title">Cadastro de Produtos</h2>

            <form action="/produto/salvar" method="POST" enctype="multipart/form-data">
                
                <!-- Layout de Formulário (Substituindo row/col por grid/flex) -->
                <div class="space-y-4">
                    
                    <?php
                    // Helper para gerar um campo de input/select padronizado
                    function render_form_field($label, $icon, $id, $name, $type = 'text', $placeholder = null, $required = true, $options = [], $step = null, $multiple = false) {
                    // Mantenha as suas linhas de código originais, mas adicione este isset/default check
                    // Se o seu PHP estiver reclamando do argumento $multiple no escopo interno da função.
                    if (!isset($multiple)) {
                        $multiple = false;
                    }
                    
                    $required_attr = $required ? 'required' : '';
                    $placeholder_attr = $placeholder ? "placeholder=\"$placeholder\"" : '';
                    $step_attr = $step ? "step=\"$step\"" : '';
                    
                    // LINHA 90
                    $multiple_attr = $multiple ? 'multiple' : ''; // Adiciona 'multiple' para arquivos
                    // LINHA 91
                    $array_name = $multiple ? '[]' : ''; // Adiciona '[]' para enviar múltiplos arquivos em um array

                    echo "<div class='flex flex-col sm:flex-row items-start sm:items-center space-y-1 sm:space-y-0 sm:space-x-4'>";

                    // Label (w-full sm:w-40 flex-shrink-0)
                    echo "<label for='$id' class='flex items-center text-lg text-gray-700 font-medium w-full sm:w-40'>";
                    echo "<i class=\"$icon mr-2 text-primary-purple\"></i> $label";
                        echo "</label>";
                        
                        // Input/Select (flex-grow)
                        echo "<div class='w-full'>";
                        if ($type === 'select' && !empty($options)) {
                            echo "<select class='w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary-purple focus:border-primary-purple outline-none transition duration-150 appearance-none' id='$id' name='$name' $required_attr>";
                            echo "<option value='' selected disabled>Selecione a categoria</option>";
                            foreach ($options as $option) {
                                $id = htmlspecialchars($option['id']);
                                $nome = htmlspecialchars($option['nome']);
                                echo "<option value=\"$id\">$nome</option>";
                            }
                            echo "</select>";
                        } else {
                             echo "<input type='$type' class='w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary-purple focus:border-primary-purple outline-none transition duration-150' id='$id' name='$name' $placeholder_attr $required_attr $step_attr>";
                        }
                        echo "</div>"; // End w-full
                        
                        echo "</div>"; // End flex
                    }
                    ?>

                    <!-- Categoria -->
                    <?php 
                    render_form_field('Categoria', 'fas fa-list', 'id_categoria', 'txt_categoria', 'select', null, true, $data['categorias']);
                    ?>

                    <!-- Nome -->
                    <?php 
                    render_form_field('Nome', 'fas fa-tag', 'nome', 'txt_nome', 'text', 'Digite o nome do produto');
                    ?>

                    <!-- Descrição -->
                    <?php 
                    render_form_field('Descrição', 'fas fa-align-left', 'descricao', 'txt_descricao', 'text', 'Digite a descrição');
                    ?>

                    <!-- Preço -->
                    <?php 
                    render_form_field('Preço (R$)', 'fas fa-dollar-sign', 'preco', 'txt_preco', 'number', '0.00', true, [], '0.01');
                    ?>

                    <!-- Imagem -->
                    <?php 
                    render_form_field('Imagem', 'fas fa-image', 'imagem', 'txt_imagem', 'file');
                    ?>

                    <!-- Quantidade -->
                    <?php 
                    render_form_field('Quantidade', 'fas fa-cubes', 'quantidade', 'txt_quantidade', 'number', null, true, [], '1');
                    ?>
                </div>

                <!-- Botões de Ação (d-flex justify-content-end gap-2) -->
                <div class="flex justify-end space-x-4 mt-8 pt-4 border-t border-gray-100">
                    <a href="/produto" class="px-6 py-3 text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 transition duration-150 font-semibold shadow-md hover:shadow-lg">
                        Cancelar
                    </a>
                    <!-- Botão Primário (bg-primary-purple, hover:bg-primary-hover) -->
                    <button type="submit" class="px-6 py-3 text-white rounded-xl transition duration-200 font-bold shadow-md hover:shadow-lg
                                               bg-primary-purple hover:bg-primary-hover focus:outline-none focus:ring-4 focus:ring-purple-300">
                        <i class="fas fa-save mr-2"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. LISTA DE PRODUTOS -->
    <div class="max-w-full mx-auto">
        <!-- Card para Listagem -->
        <div class="bg-card-bg rounded-xl shadow-xl p-6 md:p-10 transition duration-300">
            <h3 class="text-2xl font-bold mb-6 text-card-title">Lista de Produtos</h3>
            
            <!-- Tabela Responsiva (overflow-x-auto) -->
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-inner">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-id-badge"></i> ID
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-list"></i> Categoria
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-tag"></i> Nome
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                <i class="fas fa-align-left"></i> Descrição
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-dollar-sign"></i> Preço
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                <i class="fas fa-image"></i> Imagem
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-box"></i> Quantidade
                            </th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="fas fa-cog"></i> Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php $placeholder_img_base = "https://via.placeholder.com/150/0000FF/FFFFFF?text=Sem+Imagem"; ?>
                        <?php foreach ($data['produtos'] as $produto): 
                            // O campo de imagem é substituído por um placeholder, já que não temos o upload real.
                            $img_url = str_replace('?text=Produto', '?text=' . urlencode($produto['nome']), $placeholder_img_base);
                        ?>
                        <tr class="hover:bg-gray-50 transition duration-100">
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($produto['id']) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700"><?= htmlspecialchars($produto['categoria']) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700"><?= htmlspecialchars($produto['nome']) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-700 truncate max-w-xs hidden md:table-cell"><?= htmlspecialchars($produto['descricao']) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-green-600">R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-green-600"><img src="/uploads/produto/<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem do Produto" class="w-16 h-16 object-cover rounded-md"></td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-green-600"><?= htmlspecialchars($produto['quantidade'])?></td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium space-y-2 sm:space-y-0 sm:space-x-2">
                                <!-- Botão Editar -->
                                <button type="button" 
                                        class="text-blue-600 hover:text-blue-800 transition duration-150 p-2 rounded-lg hover:bg-blue-50 block sm:inline-block w-full sm:w-auto"
                                        data-images-json='<?= $imagens_exemplo_json ?>' 
                                        onclick="openEditProductModal(
                                            <?= htmlspecialchars($produto['id']) ?>, 
                                            <?= htmlspecialchars($produto['id_categoria']) ?>, 
                                            '<?= htmlspecialchars($produto['nome']) ?>', 
                                            '<?= htmlspecialchars($produto['descricao']) ?>', 
                                            '<?= htmlspecialchars($produto['preco']) ?>', 
                                            '<?= htmlspecialchars($produto['quantidade']) ?>',
                                            '<?= $img_url ?>'
                                        )">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </button>
                                <!-- Botão Excluir (Estilo Primário) -->
                                <a href="/produto/excluir/<?= htmlspecialchars($produto['id']) ?>" 
                                   class="text-white px-3 py-2 rounded-lg transition duration-200 text-sm font-semibold block sm:inline-block w-full sm:w-auto
                                          bg-primary-purple hover:bg-primary-hover focus:outline-none focus:ring-4 focus:ring-purple-300">
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

<!-- 3. MODAL DE EDIÇÃO (Tailwind/JS Puro) -->
<div id="editProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 transition-opacity duration-300 p-4" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl p-6 transform transition-all duration-300 scale-95 opacity-0 overflow-y-auto max-h-full" id="modalContentProduct">
        
        <!-- Header do Modal -->
        <div class="flex justify-between items-center pb-4 border-b border-gray-200 mb-4">
            <h5 class="text-xl font-bold text-gray-800" id="editProductModalLabel">Editar Produto</h5>
            <button type="button" class="text-gray-400 hover:text-gray-600 transition duration-150" onclick="closeEditProductModal()" aria-label="Close">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <!-- Body/Formulário do Modal -->
        <div>
            <form action="/produto/editar" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="edit-id" name="txt_id">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Coluna Principal (8/12 no Bootstrap original) -->
                    <div class="md:col-span-2 space-y-4">
                        
                        <!-- Categoria -->
                        <div>
                            <label for="edit-id-categoria" class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-list"></i> Categoria</label>
                            <select class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary-purple focus:border-primary-purple outline-none transition duration-150 appearance-none" id="edit-id-categoria" name="txt_categoria" required>
                                <option value="" disabled>Selecione...</option>
                                <?php foreach ($data['categorias'] as $categoria): ?>
                                    <option value="<?= htmlspecialchars($categoria['id']) ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Nome -->
                        <div>
                            <label for="edit-nome" class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-tag"></i> Nome</label>
                            <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary-purple focus:border-primary-purple outline-none transition duration-150" id="edit-nome" name="txt_nome" required>
                        </div>
                        
                        <!-- Descrição -->
                        <div>
                            <label for="edit-descricao" class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-align-left"></i> Descrição</label>
                            <textarea class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary-purple focus:border-primary-purple outline-none transition duration-150" id="edit-descricao" name="txt_descricao" rows="3" required></textarea>
                        </div>
                        
                        <!-- Preço e Quantidade (Row dentro de Col) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="edit-preco" class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-dollar-sign"></i> Preço (R$)</label>
                                <input type="number" step="0.01" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary-purple focus:border-primary-purple outline-none transition duration-150" id="edit-preco" name="txt_preco" required>
                            </div>
                            <div>
                                <label for="edit-quantidade" class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-cubes"></i> Quantidade</label>
                                <input type="number" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary-purple focus:border-primary-purple outline-none transition duration-150" id="edit-quantidade" name="txt_quantidade" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Coluna Lateral (4/12 no Bootstrap original) -->
                    <div class="md:col-span-1 border-t md:border-t-0 md:border-l border-gray-200 pt-4 md:pt-0 md:pl-4">
                        <div class="space-y-4 text-center">
                            <label class="block text-sm font-bold text-gray-700">Imagem Atual</label>
                            <img id="current-product-image" src="" alt="Imagem do Produto" class="w-full h-auto object-cover rounded-lg shadow-md border border-gray-300 mx-auto" style="max-height: 200px;">
                            
                            <label for="edit-imagem" class="block text-sm font-medium text-gray-700 pt-2">Alterar Imagem</label>
                            <input type="file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-purple file:text-white hover:file:bg-primary-hover" id="edit-imagem" name="txt_imagem">
                        </div>
                    </div>
                </div>
                
                <!-- Botões de Ação do Modal -->
                <div class="flex justify-end space-x-4 mt-6 pt-4 border-t border-gray-100">
                    <button type="button" class="px-6 py-3 text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 transition duration-150 font-semibold shadow-md" onclick="closeEditProductModal()">Cancelar</button>
                    <!-- Botão Primário (bg-primary-purple, hover:bg-primary-hover) -->
                    <button type="submit" class="px-6 py-3 text-white rounded-xl transition duration-200 font-bold shadow-md hover:shadow-lg
                                               bg-primary-purple hover:bg-primary-hover focus:outline-none focus:ring-4 focus:ring-purple-300">
                        <i class="fas fa-save mr-2"></i> Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript para o Modal (Substituindo dependências do Bootstrap JS) -->
<script>
    // Referências aos elementos do Modal
    const editProductModal = document.getElementById('editProductModal');
    const modalContentProduct = document.getElementById('modalContentProduct');
    
    // Funções para controle do Modal
    function openEditProductModal(id, idCategoria, nome, descricao, preco, quantidade, imagemSrc) {
        // 1. Preenche os campos do formulário
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-id-categoria').value = idCategoria;
        document.getElementById('edit-nome').value = nome;
        document.getElementById('edit-descricao').value = descricao;
        document.getElementById('edit-preco').value = preco;
        document.getElementById('edit-quantidade').value = quantidade;
        document.getElementById('current-product-image').src = imagemSrc;
        
        // Limpa o input de arquivo
        document.getElementById('edit-imagem').value = ''; 
        
        // 2. Torna o modal visível
        editProductModal.classList.remove('hidden');
        editProductModal.classList.add('flex');
        
        // 3. Aplica a animação de entrada (após um pequeno delay para a transição funcionar)
        setTimeout(() => {
            modalContentProduct.classList.remove('scale-95', 'opacity-0');
            modalContentProduct.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeEditProductModal() {
        // 1. Aplica a animação de saída
        modalContentProduct.classList.remove('scale-100', 'opacity-100');
        modalContentProduct.classList.add('scale-95', 'opacity-0');
        
        // 2. Oculta o modal após a transição
        setTimeout(() => {
            editProductModal.classList.remove('flex');
            editProductModal.classList.add('hidden');
        }, 300); // 300ms corresponde à duração da transição no Tailwind
    }

    // Fecha o modal ao clicar fora dele
    editProductModal.addEventListener('click', (event) => {
        if (event.target === editProductModal) {
            closeEditProductModal();
        }
    });

    // Fecha o modal ao pressionar ESC
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !editProductModal.classList.contains('hidden')) {
            closeEditProductModal();
        }
    });

</script>
</body>
</html> 