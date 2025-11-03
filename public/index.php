<?php
ob_start();
session_start();
// Assumindo que a variável $usuarioLogado está estruturada de forma semelhante
// Exemplo de objeto simulado para teste:
/*
$usuarioLogado = (object)[
    'id' => 1,
    'nome' => 'João Silva',
    'tipo' => 1, // 1 para admin, 0 para usuário comum
    'foto' => 'profile.jpg' // ou null
];
*/
$usuarioLogado = isset($_SESSION['usuario_logado']) ? $_SESSION['usuario_logado'] : null;
require '../Application/autoload.php';
use Application\core\App;
use Application\core\Controller;

// Função simplificada para inserir o CSS/JS do Tailwind, pois não faremos mais o swap condicional.
function inserirCssJs() {
    // Tailwind CSS CDN (Recomendado para prototipação e uso no sandbox)
    echo '<script src="https://cdn.tailwindcss.com"></script>';
    // Configuração do Tailwind para usar a cor do tema
    echo '<style>:root { --color-primary: #8987f8; }</style>';
    // Inclui classes Tailwind personalizadas (se necessário)
}

$rotasBootstrap = ['/', '/home', '/categoria', '/produto', '/usuario', '/endereco', '/carrinho', '/compra']; // Rota array mantida, mas a lógica de swap foi removida.
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essência Joias</title>
    <?php inserirCssJs(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
  </head>
  <body class="min-h-screen flex flex-col">

    <!-- Navbar/Header (de navbar/navbar-expand-lg para flex/responsive) -->
    <nav class="bg-[#8987f8] p-4 shadow-md">
      <div class="container mx-auto flex flex-wrap items-center justify-between">
        
        <!-- Brand/Logo (de navbar-brand fw-bold text-white) -->
        <a class="text-white font-bold text-2xl tracking-wider" href="/">
          <i class="fas fa-star mr-2"></i> Essência Joias
        </a>
        
        <!-- Navbar Toggler (de navbar-toggler) -->
        <button id="navbar-toggle" class="lg:hidden text-white hover:text-gray-200 focus:outline-none" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
        
        <!-- Navbar Collapse (de collapse navbar-collapse justify-content-end) -->
        <div class="w-full lg:flex lg:items-center lg:w-auto hidden" id="navbarNav">
          <ul class="lg:flex items-center space-y-2 lg:space-y-0 lg:space-x-4 pt-4 lg:pt-0">
            
            <!-- Home Link -->
            <li class="nav-item">
              <a class="block lg:inline-block text-white hover:text-gray-200 transition duration-150 ease-in-out p-2 rounded" href="/home">
                <i class="fas fa-home mr-1"></i> Home
              </a>
            </li>
            
            <!-- Admin Menu Dropdown -->
            <?php if ($usuarioLogado): ?>
              <?php if (!empty($usuarioLogado->tipo == 1)): ?>
                <li class="relative">
                  <button class="flex items-center text-white hover:text-gray-200 transition duration-150 ease-in-out p-2 rounded focus:outline-none" 
                          id="menuDropdownBtn" type="button" onclick="toggleDropdown('menuDropdown')">
                    <i class="fas fa-bars mr-1"></i> Menu
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                  </button>
                  
                  <!-- Dropdown Menu (de dropdown-menu) -->
                  <ul id="menuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden" aria-labelledby="menuDropdownBtn">
                    <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/categoria"><i class="fas fa-list-alt mr-2"></i> Categoria</a></li>
                    <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/produto"><i class="fas fa-box-open mr-2"></i> Produto</a></li>
                    <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario"><i class="fas fa-user-circle mr-2"></i> Usuario</a></li>
                    <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/carrinho"><i class="fas fa-shopping-cart mr-2"></i> Carrinho</a></li>
                    <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/compra"><i class="fas fa-shopping-basket mr-2"></i> Compra</a></li>
                    <li><hr class="border-t border-gray-200 my-1"></li>
                    <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/entrar"><i class="fas fa-sign-in-alt mr-2"></i> Login</a></li>
                    <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/cadastro"><i class="fas fa-user-plus mr-2"></i> Cadastro</a></li>
                  </ul>
                </li>
              <?php endif; ?>
            <?php endif; ?>
            
            <!-- User/Profile Dropdown -->
            <li class="relative">
              <?php if ($usuarioLogado): ?>
                <button class="flex items-center text-white hover:text-gray-200 transition duration-150 ease-in-out p-2 rounded focus:outline-none" 
                        id="userDropdownBtn" type="button" onclick="toggleDropdown('userDropdown')">
                  <?php if (!empty($usuarioLogado->foto)): ?>
                    <img src="/uploads/foto/<?= htmlspecialchars($usuarioLogado->foto) ?>" alt="Foto" class="rounded-full mr-2 w-7 h-7 object-cover border border-white">
                  <?php else: ?>
                    <i class="fas fa-user-circle mr-2 text-2xl"></i>
                  <?php endif; ?>
                  <span class="hidden sm:inline"><?= htmlspecialchars($usuarioLogado->nome) ?></span>
                  <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <!-- Logged In Dropdown Menu -->
                <ul id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden" aria-labelledby="userDropdownBtn">
                  <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/perfil/<?= htmlspecialchars($usuarioLogado->id) ?>"><i class="fas fa-user mr-2"></i> Perfil</a></li>
                  <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/carrinho/listar"><i class="fas fa-shopping-cart mr-2"></i> Carrinho</a></li>
                  <li><hr class="border-t border-gray-200 my-1"></li>
                  <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/sair"><i class="fas fa-sign-out-alt mr-2"></i> Sair</a></li>
                </ul>
              <?php else: ?>
                <button class="flex items-center text-white hover:text-gray-200 transition duration-150 ease-in-out p-2 rounded focus:outline-none" 
                        id="userDropdownBtn" type="button" onclick="toggleDropdown('userDropdown')">
                  <i class="fas fa-user mr-1"></i> Usuário
                  <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <!-- Logged Out Dropdown Menu -->
                <ul id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden" aria-labelledby="userDropdownBtn">
                  <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/entrar"><i class="fas fa-sign-in-alt mr-2"></i> Login</a></li>
                  <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/cadastro"><i class="fas fa-user-plus mr-2"></i> Cadastrar</a></li>
                </ul>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php
          // Código original para iniciar o App
          $app = new App();
        ?>
      </div>
    </main>

    <!-- Footer (de text-white py-3 mt-5) -->
    <footer class="text-white py-4 mt-8 bg-[#8987f8] shadow-inner">
      <div class="container mx-auto text-center px-4">
        &copy; 2025 Essência Joias. Todos os direitos reservados.
      </div>
    </footer>

    <!-- JavaScript para replicar o comportamento de Toggler e Dropdown do Bootstrap -->
    <script>
      // 1. Dropdown Logic
      function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        if (dropdown) {
          // Fecha outros dropdowns abertos (opcional, mas boa prática)
          document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
            if (menu.id !== id && !menu.classList.contains('hidden')) {
              menu.classList.add('hidden');
            }
          });
          
          // Toggle no dropdown atual
          dropdown.classList.toggle('hidden');
        }
      }

      // Fecha dropdown ao clicar fora
      document.addEventListener('click', function(event) {
        const isDropdownButton = event.target.closest('[id$="DropdownBtn"]');
        const isDropdownMenu = event.target.closest('[id$="Dropdown"]');

        if (!isDropdownButton && !isDropdownMenu) {
          document.querySelectorAll('.relative > ul').forEach(menu => {
            menu.classList.add('hidden');
          });
        }
      });


      // Adiciona classe de identificação para o JS (os <ul> dropdown)
      document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.relative > ul').forEach(menu => {
            menu.classList.add('dropdown-menu-custom');
        });

        // 2. Navbar Toggler Logic (Mobile)
        const toggleButton = document.getElementById('navbar-toggle');
        const navBar = document.getElementById('navbarNav');

        if (toggleButton && navBar) {
          toggleButton.addEventListener('click', () => {
            navBar.classList.toggle('hidden');
            // Altera o atributo aria-expanded para acessibilidade
            const isExpanded = navBar.classList.contains('hidden') ? 'false' : 'true';
            toggleButton.setAttribute('aria-expanded', isExpanded);
          });
        }
      });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/code.js"></script>
    
    <!-- Script original do Bootstrap-Select foi removido pois usava dependências de Bootstrap JS.
         Se você precisa de um "select" customizado, precisará integrá-lo com JS puro/JQuery ou
         usar uma biblioteca de seleção que funcione com Tailwind. -->
  </body>
</html>
