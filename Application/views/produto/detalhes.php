<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['produto']['nome'] ?? 'Detalhes do Produto') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Estilos baseados no CSS original, mas adaptando o fundo para um visual mais limpo (ML) */
        :root {
            --color-title: #333333; /* Cor do título mais escura */
            --color-primary: #3483fa; /* Azul típico de ação do ML */
            --color-primary-hover: #2968c8;
            --color-card-bg: #ffffff; /* Fundo branco puro */
            --color-price: #000000; /* Preço em preto/escuro para destaque */
        }
        
        body {
            /* Fundo limpo e suave */
            background-color: #f5f5f5; /* Cinza claro, como no ML */
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }
        
        /* Estilo para a miniatura ativa (mantendo a cor roxa original ou usando azul) */
        .thumbnail-active {
            border: 3px solid var(--color-primary); /* Azul de destaque */
            box-shadow: 0 0 5px rgba(52, 131, 250, 0.5); 
        }

        /* Removendo a sombra do card, focando na borda limpa */
        .card-shadow {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
    </style>

    <script>
        // Configuração do Tailwind para mapear cores customizadas
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Cores de Ação (Comprar)
                        'primary-blue': '#6D28D9', 
                        'primary-hover-dark': '#2a056eff',
                        // Cores de destaque (ML usa amarelo/laranja para Vantagens)
                        'highlight-yellow': '#fff159',
                        // Fundo/Cards
                        'card-title-dark': '#333333',
                        'card-bg': '#ffffff',
                    }
                }
            }
        }
    </script>
</head>
<body class="p-4">

    <!-- Container Máximo ajustado para 6xl para uma visualização ampla -->
    <div class="max-w-6xl mx-auto my-8 flex justify-center items-start">

        <!-- Card principal: Fundo Branco e Sombra Suave -->
        <div class="bg-white rounded-lg card-shadow w-full transition duration-300">
            
            <?php if (!empty($data['produto'])): ?>

                <div class="flex flex-col md:flex-row">
                    
                    <!-- Coluna da Imagem: md:w-7/12 (Mais espaço para a imagem) -->
                    <div class="md:w-7/12 p-6 flex flex-col items-center border-r border-gray-100">
                        
                        <!-- Main Image Container -->
                        <div class="bg-white w-full max-w-lg flex items-center justify-center p-6 mb-6">
                            <!-- Imagem principal maior e sem limite de altura rígido -->
                            <img src="/uploads/produto/<?= htmlspecialchars($data['produto']['imagem']) ?>" 
                                alt="<?= htmlspecialchars($data['produto']['nome']) ?>"
                                id="main-product-image"
                                class="rounded-lg w-full h-auto object-contain transition duration-300 transform hover:scale-[1.02] max-h-[500px]">
                        </div>

                        <!-- Thumbnails (Miniaturas) -->
                        <div class="flex flex-wrap gap-3 justify-center">
                            
                            <?php 
                            $base_path = "/uploads/produto/";
                            $all_photos = array_merge(
                                [['foto' => $data['produto']['imagem'], 'is_main' => true]], 
                                $data['fotos'] ?? []
                            );
                            
                            foreach($all_photos as $index => $foto): 
                                $is_main = $foto['is_main'] ?? false;
                                $src = htmlspecialchars($base_path . $foto['foto']);
                            ?>
                                <img src="<?= $src ?>" 
                                    alt="Miniatura <?= $index + 1 ?>"
                                    data-src="<?= $src ?>"
                                    class="thumbnail-image w-16 h-16 object-cover rounded-md cursor-pointer border-2 border-gray-200 transition duration-150 hover:border-primary-blue <?= $is_main ? 'thumbnail-active' : '' ?>">
                            <?php endforeach; ?>

                        </div>
                        
                    </div>


                    <!-- Coluna de Detalhes: md:w-5/12 -->
                    <div class="md:w-5/12 p-6">

                        <!-- MOCK: Avaliações e Vendas (Estilo ML) -->
                        <div class="text-sm text-gray-500 mb-2">
                            Novo | +50 vendidos
                        </div>
                        <div class="flex items-center text-sm text-gray-700 mb-4">
                            <i class="fas fa-star text-primary-blue mr-1"></i>
                            <i class="fas fa-star text-primary-blue mr-1"></i>
                            <i class="fas fa-star text-primary-blue mr-1"></i>
                            <i class="fas fa-star text-primary-blue mr-1"></i>
                            <i class="fas fa-star-half-alt text-primary-blue mr-2"></i>
                            (120 Avaliações)
                        </div>

                        <!-- Título do Produto -->
                        <h1 class="text-2xl lg:text-3xl font-semibold mb-4 text-card-title-dark">
                            <?= htmlspecialchars($data['produto']['nome']) ?>
                        </h1>
                        
                        <div class="text-lg text-gray-500 mb-1">
                             Preço original: <span class="line-through">R$ <?= htmlspecialchars(number_format($data['produto']['preco'] * 1.2, 2, ',', '.')) ?></span>
                        </div>

                        <!-- Preço (Em Destaque) -->
                        <div class="flex items-end mb-6">
                            <span class="text-3xl lg:text-5xl font-extrabold text-color-price mr-2">
                                R$ <?= htmlspecialchars(number_format($data['produto']['preco'], 2, ',', '.')) ?>
                            </span>
                        </div>

                        <!-- MOCK: Vantagens de Compra (Ex: Frete Grátis) -->
                         <div class="bg-highlight-yellow/50 p-3 rounded-lg text-gray-900 font-semibold mb-6">
                            <i class="fas fa-truck text-primary-blue mr-2"></i> Frete grátis e Parcelamento sem juros!
                        </div>

                        <!-- Descrição -->
                        <p class="mb-6 text-gray-600 leading-relaxed text-sm">
                            <?= htmlspecialchars($data['produto']['descricao']) ?>
                        </p>
                        
                        <!-- Botões de Ação -->
                        <div class="flex flex-col gap-3 mb-6"> 
                            
                            <!-- Botão Principal: COMPRAR AGORA (Azul Primário) -->
                            <a href="/carrinho/adicionar/<?= htmlspecialchars($data['produto']['id']) ?>" 
                               class="text-center px-6 py-3 rounded-lg transition duration-200 font-bold shadow-md 
                                     text-white bg-primary-blue hover:bg-primary-hover-dark focus:ring-4 focus:ring-blue-300 text-lg">
                                <i class="fas fa-bolt mr-2"></i> Comprar Agora
                            </a>

                            <?php 
                            $carrinho_link = isset($_SESSION['usuario_logado']) ? 
                                "/carrinho/listar/{$data['produto']['id']}" : 
                                "/usuario/entrar/";
                            ?>
                            
                            <!-- Botão Secundário: ADICIONAR AO CARRINHO (Cor Secundária ou Borda) -->
                              <a href="<?= $carrinho_link ?>" 
                               class="flex-1 text-center px-6 py-3 rounded-xl transition duration-200 font-semibold shadow-lg 
                                      text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300">
                                <i class="fas fa-cart-plus mr-2"></i> Ir para o Carrinho
                            </a>
                        </div>
                    </div>
                </div>
                
                <?php else: ?>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg m-6" role="alert">
                    <p class="font-bold">Atenção!</p>
                    <p>Produto não encontrado.</p>
                </div>

                
            <?php endif; ?>
            
            <?php if (!empty($data['msg'])): ?>
                <div class="p-6 pt-0 border-t border-gray-100">
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg mt-3" role="alert">
                        <?= htmlspecialchars($data['msg']) ?>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainImage = document.getElementById('main-product-image');
            const thumbnails = document.querySelectorAll('.thumbnail-image');
            
            if (!mainImage || thumbnails.length === 0) return;

            // Função para carregar a imagem principal
            const loadMainImage = (newSrc) => {
                // Adiciona uma pequena transição para suavizar a mudança
                mainImage.style.opacity = 0;
                setTimeout(() => {
                    mainImage.src = newSrc;
                    mainImage.alt = newSrc.split('/').pop();
                    mainImage.style.opacity = 1;
                }, 100); 
            };

            // Função para atualizar a miniatura ativa (com a borda azul)
            const updateActiveThumbnail = (clickedThumbnail) => {
                thumbnails.forEach(thumb => {
                    thumb.classList.remove('thumbnail-active');
                    thumb.classList.add('border-gray-200'); 
                });
                
                clickedThumbnail.classList.add('thumbnail-active');
                clickedThumbnail.classList.remove('border-gray-200');
            };

            // Adiciona o event listener para cada miniatura
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', (event) => {
                    const newSrc = event.target.dataset.src; 
                    
                    loadMainImage(newSrc);
                    updateActiveThumbnail(event.target);
                });
            });
        });
    </script>
</body>
</html>