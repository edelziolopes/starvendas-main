<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Compra</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN for Icons -->
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
                        // Custom colors based on original CSS
                        'primary-purple': '#9c27b0', // Original .btn-primary default
                        'primary-hover': '#2196f3',  // Original .btn-primary hover
                        'text-purple': '#5a2e91',   // Original .card-title color
                        'card-bg': '#f8faff',        // Original .card background
                        'footer-bg': '#e6f0ff',      // Original .card-footer background
                        'badge-bg': '#e0d3f2',       // Original .badge background
                    },
                }
            }
        }
    </script>
    <style>
        /* Custom gradient for body, replacing the original style block */
        body {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e0d3f2, #f0e6ff);
            min-height: 100vh;
        }
        /* Custom style to ensure the modal elements respect the original structure while using Tailwind */
        .modal-content-custom {
             background: #f8faff;
        }
        /* Note: For the modal to function fully, a JS library like Bootstrap's would be required, 
           but only style conversion was requested. */
    </style>
</head>
<body class="font-sans">

<div class="max-w-5xl mx-auto my-10 px-4">
    <div class="flex justify-center">
        <div class="w-full">
            <!-- Card for Cadastro de Compra -->
            <div class="bg-card-bg shadow-xl rounded-xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-text-purple mb-4 text-center">Cadastro de Fotos</h2>
                    <form action="/foto/salvar" method="POST" enctype="multipart/form-data">


                        <!-- Produto -->
                        <div class="mb-4">
                            <!-- Produto Select -->
                            <div class="flex flex-col md:flex-row items-start md:items-center mb-4 space-y-2 md:space-y-0">
                                <div class="flex-shrink-0 mr-4">
                                    <label for="id_endereco" class="text-sm font-medium text-gray-700 flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2"></i> Produto
                                    </label>
                                </div>
                                <div class="flex-grow w-full">
                                    <select class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" id="id_endereco" name="txt_produto" required>
                                        <option value="" selected disabled>Selecione o produto</option>
                                        <?php foreach ($data['produtos'] as $dados): ?>
                                        <option value="<?= $dados['id'] ?>"><?= $dados['nome'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                             <div class="flex flex-col sm:flex-row sm:items-center w-full sm:w-1/2 gap-2">
                        <label for="foto" class="flex items-center w-full sm:w-32 text-sm font-medium text-gray-700">
                            <i class="fas fa-image w-4 mr-2 text-primary-purple"></i> Foto
                        </label>
                        <input type="file" class="form-input flex-1 p-2 border border-gray-300 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150 text-gray-700" id="foto" name="txt_foto" required>
                    </div>
                    </div>
   
     

                        <!-- Botões -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <a href="/" class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg shadow-sm hover:bg-gray-300 transition duration-150">Cancelar</a>
                            <button type="submit" class="px-4 py-2 bg-primary-purple text-white font-medium rounded-lg shadow-md hover:bg-primary-hover transition duration-150">
                                <i class="fas fa-save mr-1"></i> Salvar
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Compras -->
    <div class="flex justify-center mt-8">
        <div class="w-full">
            <div class="bg-card-bg shadow-xl rounded-xl">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-text-purple mb-4">Lista de Compras</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-id-badge"></i> ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-map-marker-alt"></i> Produto</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-map-marker-alt"></i> Foto</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-cog"></i> Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($data['fotos'] as $dados): ?>
                                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($dados['id']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($dados['produto']) ?></td>>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($dados['foto']) ?></td>>
                                    <td class="px-6 py-4 whitespacrap text-center text-sm font-medium">
                                        <button class="text-primary-purple hover:text-primary-hover mr-2 transition duration-150" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $dados['id'] ?>" data-compra="<?= $dados['nome']?>" data-produto="<?= $dados['produto'] ?>" data-preco="<?= $dados['preco'] ?>" data-quantidade="<?= $dados['quantidade'] ?>">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <a href="/foto/excluir/<?= $dados['id'] ?>" class="text-red-600 hover:text-red-800 transition duration-150 mt-1 inline-flex items-center">
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
        </div>
    </div>
</div>

<!-- Modal (Retained structure and data attributes for original JS logic) -->
<div class="modal fade hidden fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="modal-content-custom bg-white w-full max-w-lg mx-auto rounded-xl shadow-2xl transition-all transform translate-y-0">
            <div class="p-6">
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h5 class="text-xl font-bold text-text-purple" id="editModalLabel">Editar Compra</h5>
                    <button type="button" class="text-gray-400 hover:text-gray-600" data-bs-dismiss="modal" aria-label="Close">
                         <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/compra/editar" method="POST">
                        <input type="hidden" id="edit-id" name="txt_id">
                        <div class="mb-4">
                            <label for="edit-carrinho" class="block text-sm font-medium text-gray-700 mb-1">Carrinho</label>
                            <select class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple" id="edit-carrinho" name="txt_carrinho" required>
                                <option value="" selected disabled>Selecione o carrinho</option>
                                <?php foreach ($data['carrinhos'] as $dados): ?>
                                <option value="<?= $dados['id'] ?>"><?= $dados['usuario'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="edit-produto" class="block text-sm font-medium text-gray-700 mb-1">Produto</label>
                            <select class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple" id="edit-produto" name="txt_produto" required>
                                <option value="" selected disabled>Selecione o produto</option>
                                <?php foreach ($data['produtos'] as $dados): ?>
                                <option value="<?= $dados['id'] ?>"><?= $dados['nome'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="edit-preco" class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
                            <input type="number" class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple" id="edit-preco" name="txt_preco" required>
                        </div>
                        <div class="mb-6">
                            <label for="edit-quantidade" class="block text-sm font-medium text-gray-700 mb-1">Quantidade</label>
                            <input type="number" class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple" id="edit-quantidade" name="txt_quantidade" required>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="w-full px-4 py-2 bg-primary-purple text-white font-medium rounded-lg shadow-md hover:bg-primary-hover transition duration-150">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Original JavaScript logic remains untouched
   var editModal = document.getElementById('editModal')
   editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var modalIdInput = editModal.querySelector('#edit-id')
        var compra = button.getAttribute('data-compra')
        var modalCompraInput = editModal.querySelector('#edit-compra')
    modalIdInput.value = id
    modalCompraInput.value = compra
   })

    // Simple script to simulate modal behavior since Bootstrap JS is not included
    // Find all elements with data-bs-toggle="modal" and attach a click listener
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', (e) => {
            const modalId = button.getAttribute('data-bs-target');
            const modal = document.querySelector(modalId);
            if (modal) {
                modal.classList.remove('hidden');
            }
        });
    });

    // Find all elements with data-bs-dismiss="modal" and attach a click listener
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
        button.addEventListener('click', (e) => {
            let element = button.closest('.modal');
            if (!element) {
                // If the element itself is the modal (e.g., clicking outside)
                element = document.getElementById('editModal');
            }
            if (element) {
                element.classList.add('hidden');
            }
        });
    });

    // Handle clicks outside the modal content
    const editModalElement = document.getElementById('editModal');
    if (editModalElement) {
        editModalElement.addEventListener('click', (e) => {
            if (e.target.id === 'editModal') {
                editModalElement.classList.add('hidden');
            }
        });
    }

    // Since the original JS uses the 'show.bs.modal' event, which requires Bootstrap's JS,
    // the functionality of passing data to the modal via JS attributes will likely not work 
    // without the full Bootstrap library. However, the HTML and styling now strictly use Tailwind.
</script>
</body>
</html>
