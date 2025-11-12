<style>
  body {
    background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e0d3f2, #f0e6ff);
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
  }
  .card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 20px rgba(0,0,0,0.07);
    background: #f8faff;
  }
  .card-title {
    color: #5a2e91;
    font-weight: 600;
  }
  .btn-primary {
    background-color: #9c27b0;
    border-color: #9c27b0;
  }
  .btn-primary:hover {
    background-color: #2196f3;
    border-color: #2196f3;
  }
  .badge.bg-secondary {
    background-color: #e0d3f2;
    color: #5a2e91;
  }
  .card-footer {
    background: #e6f0ff;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
  }
</style>
<div class="max-w-4xl mx-auto mt-6">
    <h2 class="text-4xl font-extrabold text-center mb-8 text-gray-800">Produtos no Carrinho</h2>

    <?php
    // Agrupa produtos pelo id e soma quantidade
    $produtosAgrupados = [];
    if (!empty($data['produtos'])) {
        foreach ($data['produtos'] as $produto) {
            $id = $produto['id'];
            if (!isset($produtosAgrupados[$id])) {
                $produtosAgrupados[$id] = $produto;
                $produtosAgrupados[$id]['quantidade_carrinho'] = 1;
            } else {
                $produtosAgrupados[$id]['quantidade_carrinho']++;
            }
        }
    }
    ?>

    <?php if (!empty($produtosAgrupados)): ?>
        <div class="space-y-6">
            <?php foreach ($produtosAgrupados as $produto): ?>
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden">
                    <div class="flex flex-col md:flex-row">
                        
                        <div class="md:w-5/12 flex items-center justify-center p-4 md:p-6 bg-gray-50">
                            <img src="/uploads/produto/<?= htmlspecialchars($produto['imagem']) ?>"
                                class="rounded-lg shadow-md w-full h-auto max-h-[180px] object-contain transition duration-300 transform hover:scale-[1.02]">
                        </div>
                        
                        <div class="md:w-7/12 p-4 md:p-6">
                            
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full 
                                        bg-indigo-100 text-indigo-700 mb-2">
                                <?= htmlspecialchars($produto['categoria']) ?>
                            </span>
                            
                            <h3 class="text-2xl font-bold mb-2 text-gray-900">
                                <?= htmlspecialchars($produto['nome']) ?>
                            </h3>

                             <p class="mb-4 text-gray-600 leading-relaxed">
                            <?= htmlspecialchars($produto['descricao']) ?>
                            </p>
                            
                            <div class="flex items-end justify-between mt-4">
                                <h4 class="text-3xl font-black text-purple-600">
                                    R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?>
                                </h4>
                                
                                <div class="flex items-center space-x-4">
                                    <span class="text-lg font-semibold text-gray-700 p-2 rounded-lg bg-gray-100">
                                        Qtd: <?= htmlspecialchars($produto['quantidade_carrinho']) ?>
                                    </span>
                                    <a href="/carrinho/remover/<?= $produto['id'] ?>" 
                                       class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition duration-150 shadow-md">
                                        Remover
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-8 bg-white rounded-xl shadow-2xl p-6 flex justify-between items-center border-t border-gray-100">
            <span class="text-2xl font-extrabold text-gray-800">
                Total: R$ <?= htmlspecialchars(number_format($data['total'], 2, ',', '.')) ?>
            </span> 
            <form action="/carrinho/finalizar" method="POST">
                <?php 
                    foreach ($produtosAgrupados as $item): 
                ?>

                <input type="hidden" name="produto_id[]" 
                value="<?php echo $item['id']; ?>">
                <input type="hidden" name="produto_quantidade[]" value="<?php echo $item['quantidade_carrinho']; ?>">

                <?php endforeach;  ?>

                <button type="submit" class="px-8 py-3 text-lg font-bold text-white bg-green-600 rounded-xl hover:bg-green-700 transition duration-200 shadow-xl focus:ring-4 focus:ring-green-300">
                Finalizar Compra
                </button>
            </form>
        </div>


    <?php else: ?>
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-6 rounded-lg my-8" role="alert">
            <p class="font-bold text-xl mb-1">Seu carrinho está vazio!</p>
            <p>Nenhum produto foi adicionado ainda. Explore nossos produtos para começar sua compra.</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($data['msg'])): ?>
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg mt-6" role="alert">
            <?= htmlspecialchars($data['msg']) ?>
        </div>
    <?php endif; ?>

</div>