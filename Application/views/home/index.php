<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($data['produto']['nome'] ?? 'Detalhes do Produto') ?></title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudfcom/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    :root {
      --color-primary: #6D28D9;
      --color-title: #6D28D9;
      --color-primary-hover: #2a056eff;
      --color-card-bg: #ffffffff;
      --badge-bg-color: #ffffffff;
      --badge-text-color: #6D28D9;
    }

    body {
      background-color: 
       bbbbb#000000ff;
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      color: #1f2937;
    }

    .product-card {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.5s ease-out forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'primary-purple': 'var(--color-primary)',
            'primary-hover': 'var(--color-primary-hover)',
            'card-title': 'var(--color-title)',
            'card-bg': 'var(--color-card-bg)',
            'badge-bg': 'var(--badge-bg-color)',
            'badge-text': 'var(--badge-text-color)',
          }
        }
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      const cards = document.querySelectorAll('.product-card');
      cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.05}s`;
      });
    });
  </script>
</head>
<body class="p-4 sm:p-6 lg:p-10">

  <div class="container mx-auto max-w-7xl">

    <!-- Hero Section -->
    <header class="text-center py-12 mb-8 bg-white/70 backdrop-blur-sm rounded-3xl shadow-2xl border border-gray-100">
      <h1 class="text-5xl font-extrabold text-card-title mb-3 leading-tight sm:text-6xl">
        Descubra Nossos Produtos Incríveis
      </h1>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        A melhor seleção de itens, feita sob medida para você. Qualidade e inovação garantidas!
      </p>
    </header>

    <!-- Grade de Produtos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
      <?php 
      $produtos = isset($data['produtos']) ? $data['produtos'] : [
        ['id' => 1, 'nome' => 'Produto Premium Pro', 'descricao' => 'Este é um produto de alta performance com design elegante e funcionalidade superior.', 'categoria' => 'Eletrônicos', 'preco' => 129.90, 'imagem' => 'placeholder.jpg'],
        ['id' => 2, 'nome' => 'Kit Essencial de Viagem', 'descricao' => 'Tudo o que você precisa para uma viagem perfeita, compacto e eficiente.', 'categoria' => 'Acessórios', 'preco' => 49.99, 'imagem' => 'placeholder2.jpg'],
        ['id' => 3, 'nome' => 'Caneca Térmica Aço Inox', 'descricao' => 'Mantém sua bebida quente ou fria por horas. Perfeita para o dia a dia.', 'categoria' => 'Casa & Cozinha', 'preco' => 75.00, 'imagem' => 'placeholder3.jpg'],
        ['id' => 4, 'nome' => 'Fone Bluetooth Xtreme', 'descricao' => 'Qualidade de som cristalina e bateria de longa duração para horas de música.', 'categoria' => 'Áudio', 'preco' => 199.50, 'imagem' => 'placeholder4.jpg'],
      ];

      if (is_array($produtos) && count($produtos) > 0):
        foreach ($produtos as $produto): ?>
          <div class="product-card bg-white rounded-2xl shadow-xl hover:shadow-primary-purple/50 hover:-translate-y-1 transition duration-500 ease-in-out transform flex flex-col h-full border border-gray-100">
                <div class="relative overflow-hidden h-52 rounded-t-2xl">
                    <img src="/uploads/produto/<?= htmlspecialchars($produto['imagem']) ?>"
                    class="w-full h-full object-cover transition duration-500 ease-in-out transform hover:scale-105"
                    alt="<?= htmlspecialchars($produto['nome']) ?>"
                    onerror="this.onerror=null;this.src='https://placehold.co/400x300/E5D7FA/6D28D9?text=Produto';" />
                    <span class="absolute top-3 right-3 bg-badge-bg text-badge-text text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                    <?= htmlspecialchars($produto['categoria']) ?>
                    </span>
                </div>

                <div class="p-6 flex-grow flex flex-col">
                    <h5 class="text-2xl font-bold mb-2 text-card-title leading-snug">
                    <?= htmlspecialchars($produto['nome']) ?>
                    </h5>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow">
                    <?= htmlspecialchars($produto['descricao']) ?>
                    </p>
                </div>

                <!-- INÍCIO DA ÁREA DE AÇÃO MODIFICADA -->
                <div class="bg-gray-50 p-6 flex flex-col gap-4 rounded-b-2xl border-t border-gray-100">
                    <!-- Preço -->
                    <div class="flex justify-between items-center">
                    <span class="text-2xl font-extrabold text-primary-purple">
                        R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?>
                    </span>
                    </div>
                    <!-- Botão Comprar (Largura Total) -->
                    <a href="/produto/detalhes/<?= htmlspecialchars($produto['id']) ?>"
                    class="w-full text-center px-5 py-2.5 text-base font-semibold rounded-full text-white transition duration-300 bg-primary-purple hover:bg-primary-hover shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-primary-purple/50 flex items-center justify-center space-x-2">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Comprar</span>
                    </a>
                </div>
                <!-- FIM DA ÁREA DE AÇÃO MODIFICADA -->
                </div>
        <?php endforeach;
      else: ?>
        <div class="col-span-full text-center py-10 bg-white/70 rounded-xl shadow-lg mt-8">
          <i class="fas fa-box-open text-6xl text-gray-400 mb-4"></i>
          <p class="text-xl text-gray-600">Nenhum produto encontrado para exibição no momento.</p>
          <p class="text-sm text-gray-500 mt-2">Verifique a origem dos dados ou tente novamente mais tarde.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
