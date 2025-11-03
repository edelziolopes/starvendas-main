<?php
// --- SIMULAÇÃO DE DADOS (Para renderização em ambiente estático) ---
// Em um ambiente de produção PHP, estas variáveis viriam do seu controlador.
if (!isset($data['produto'])) {
    $data['produto'] = [
        'id' => 42,
        'categoria' => 'Acessórios Premium',
        'nome' => 'Pulseira de Couro Clássica',
        'descricao' => 'Pulseira artesanal em couro legítimo, ideal para qualquer ocasião. Fecho magnético e design minimalista.',
        'preco' => 189.50,
        'imagem' => 'placeholder_bracelet.jpg',
    ];
}

// Simula o status de login para controle de botões
if (!isset($_SESSION['usuario_logado'])) {
    // Definimos como true ou false para simular o comportamento do botão "Ir para o Carrinho"
    $_SESSION['usuario_logado'] = true; 
}

$placeholder_img_url = 'https://placehold.co/400x320/a855f7/ffffff?text=' . urlencode($data['produto']['nome'] ?? 'Produto');
// -------------------------------------------------------------------
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['produto']['nome'] ?? 'Detalhes do Produto') ?></title>
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
                        'badge-bg': '#e0d3f2',           /* badge.bg-secondary */
                        'badge-text': '#5a2e91',         /* badge.bg-secondary text */
                    }
                }
            }
        }
    </script>
</head>
<body class="p-4">

    <div class="max-w-4xl mx-auto mt-6 flex justify-center items-start">
        
        <!-- Cartão Principal (Substitui .card .shadow .mx-auto) -->
        <div class="bg-card-bg rounded-xl shadow-2xl w-full transition duration-300">
            
            <?php if (!empty($data['produto'])): ?>
                
                <!-- Layout de Conteúdo (Substitui .row .g-0) -->
                <div class="flex flex-col md:flex-row">
                    
                    <!-- Imagem (Substitui .col-md-5 e centraliza) -->
                    <div class="md:w-5/12 flex items-center justify-center p-6 bg-gray-50 rounded-t-xl md:rounded-l-xl md:rounded-tr-none">
                        <img src="/uploads/produto/<?= htmlspecialchars($data['produto']['imagem']) ?>" 
                             alt="<?= htmlspecialchars($data['produto']['imagem']) ?>"
                             class="rounded-lg shadow-md w-full h-auto max-h-80 object-contain transition duration-300 transform hover:scale-[1.02]">
                    </div>
                    
                    <!-- Detalhes do Produto (Substitui .col-md-7) -->
                    <div class="md:w-7/12 p-6">
                        
                        <!-- Categoria (Substitui .badge .bg-secondary) -->
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full 
                                     bg-badge-bg text-badge-text mb-3">
                            <?= htmlspecialchars($data['produto']['categoria']) ?>
                        </span>
                        
                        <!-- Nome -->
                        <h2 class="text-3xl font-extrabold mb-3 text-card-title">
                            <?= htmlspecialchars($data['produto']['nome']) ?>
                        </h2>
                        
                        <!-- Descrição -->
                        <p class="mb-4 text-gray-600 leading-relaxed">
                            <?= htmlspecialchars($data['produto']['descricao']) ?>
                        </p>
                        
                        <!-- Preço -->
                        <h4 class="text-4xl font-black text-primary-purple mb-6">
                            R$ <?= htmlspecialchars(number_format($data['produto']['preco'], 2, ',', '.')) ?>
                        </h4>

                        <!-- Botões de Ação (Substitui .row .mb-4 e .col-6) -->
                        <div class="flex flex-col sm:flex-row gap-4 mb-6"> 
                            
                            <!-- Botão Comprar -->
                            <a href="/carrinho/adicionar/<?= htmlspecialchars($data['produto']['id']) ?>" 
                               class="flex-1 text-center px-6 py-3 rounded-xl transition duration-200 font-bold shadow-lg 
                                      text-white bg-primary-purple hover:bg-primary-hover focus:ring-4 focus:ring-purple-300">
                                <i class="fas fa-cart-plus mr-2"></i> Comprar
                            </a>
                            
                            <!-- Botão Ir para o Carrinho (Com lógica PHP) -->
                            <?php 
                            $carrinho_link = isset($_SESSION['usuario_logado']) ? 
                                "/carrinho/listar/{$data['produto']['id']}" : 
                                "/usuario/entrar/";
                            ?>
                            <a href="<?= $carrinho_link ?>" 
                               class="flex-1 text-center px-6 py-3 rounded-xl transition duration-200 font-semibold shadow-lg 
                                      text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300">
                                <i class="fas fa-shopping-cart mr-2"></i> Ir para o Carrinho
                            </a>
                        </div>
                    </div>
                </div>
                
            <?php else: ?>
                <!-- Alerta de Produto Não Encontrado (Substitui .alert .alert-warning .m-4) -->
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg m-6" role="alert">
                    <p class="font-bold">Atenção!</p>
                    <p>Produto não encontrado.</p>
                </div>
            <?php endif; ?>
            
            <!-- Mensagens de Feedback (Substitui .alert .alert-info) -->
            <?php if (!empty($data['msg'])): ?>
                <div class="p-6 pt-0 border-t border-gray-100">
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg mt-3" role="alert">
                        <?= htmlspecialchars($data['msg']) ?>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
    
</body>
</html>
