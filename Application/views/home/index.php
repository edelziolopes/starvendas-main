<?php 
// Nota: Os estilos globais como o gradiente de fundo (linear-gradient)
// e a fonte 'Inter' devem ser aplicados no arquivo de layout principal,
// como foi feito no <body> do arquivo 'index.php' na conversa anterior.
?>

<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Equivalente a .row.mt-3 com colunas responsivas (col-md-4) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <?php 
        // A variável $data['produtos'] é esperada aqui
        if (isset($data['produtos']) && is_array($data['produtos'])):
        foreach ($data['produtos'] as $produto): ?>
            
            <!-- Card (Fundo Branco: bg-white) -->
            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300 flex flex-col h-full">
                
                <!-- Imagem -->
                <img src="/uploads/produto/<?= htmlspecialchars($produto['imagem']) ?>" 
                     class="w-full h-48 object-cover rounded-t-xl" 
                     alt="<?= htmlspecialchars($produto['nome']) ?>" 
                     onerror="this.onerror=null;this.src='https://placehold.co/400x300/f8faff/36454F?text=Imagem+Nao+Disponivel';" />
                
                <!-- Card Body -->
                <div class="p-5 flex-grow">
                    <!-- Título (Texto Preto: text-gray-900) -->
                    <h5 class="text-xl font-semibold mb-2 text-gray-900"><?= htmlspecialchars($produto['nome']) ?></h5>
                    
                    <!-- Descrição (Texto Escuro: text-gray-700) -->
                    <p class="text-gray-700 text-sm mb-3 line-clamp-2"><?= htmlspecialchars($produto['descricao']) ?></p>
                    
                    <!-- Badge (Estilo Cinza neutro de alto contraste) -->
                    <span class="inline-block bg-gray-200 text-gray-800 text-xs font-medium px-3 py-1 rounded-full">
                        <?= htmlspecialchars($produto['categoria']) ?>
                    </span>
                </div>
                
                <!-- Card Footer (Fundo Cinza claro para contraste) -->
                <div class="bg-gray-100 p-4 flex justify-between items-center rounded-b-xl">
                    <!-- Preço (Texto Preto: text-gray-900) -->
                    <span class="text-lg font-bold text-gray-900">
                        R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?>
                    </span>
                    
                    <!-- Botão (Fundo Preto: bg-black, Hover: bg-gray-800, Texto Branco: text-white) -->
                    <a href="/produto/detalhes/<?= htmlspecialchars($produto['id']) ?>" 
                       class="px-4 py-2 text-sm font-medium rounded-lg text-white transition duration-200 
                              bg-black hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-400">
                        Comprar
                    </a>
                </div>
            </div>
        <?php endforeach; 
        else: ?>
            <p class="text-gray-500 text-center col-span-full">Nenhum produto encontrado para exibição.</p>
        <?php endif; ?>
    </div>
</div>
