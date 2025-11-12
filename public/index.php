<?php
ob_start();
session_start();

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

function inserirCssJs() {
    echo '<script src="https://cdn.tailwindcss.com"></script>';
}

$rotasBootstrap = ['/', '/home', '/categoria', '/produto', '/usuario', '/endereco', '/carrinho', '/compra'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Key Lab</title>
    <?php inserirCssJs(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body class="min-h-screen flex flex-col bg-white text-white">

<nav class="bg-[#6D28D9] p-4 shadow-md">
  <div class="container mx-auto flex flex-wrap items-center justify-between">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-key-fill w-20 h-20" viewBox="0 0 16 16">
      <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
</svg>
    <a class="text-white font-bold text-2xl tracking-wider" href="/">
      <i class="bi bi-key-fill"></i>  KEY LAB

    <button id="navbar-toggle" class="lg:hidden text-white hover:text-gray-200 focus:outline-none" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
      </svg>
    </button>

    <div class="w-full lg:flex lg:items-center lg:w-auto hidden" id="navbarNav">
      <ul class="lg:flex items-center space-y-2 lg:space-y-0 lg:space-x-4 pt-4 lg:pt-0">

        <li class="nav-item">
          <a class="block lg:inline-block text-white hover:text-gray-200 transition duration-150 ease-in-out p-2 rounded" href="/home">
            <i class="fas fa-home mr-1"></i> Home
          </a>
        </li>

        <?php if ($usuarioLogado): ?>
          <?php if (!empty($usuarioLogado->tipo == 1)): ?>
            <li class="relative">
              <button class="flex items-center text-white hover:text-gray-200 transition duration-150 ease-in-out p-2 rounded focus:outline-none" 
                      id="menuDropdownBtn" type="button" onclick="toggleDropdown('menuDropdown')">
                <i class="fas fa-bars mr-1"></i> Menu
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <ul id="menuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden" aria-labelledby="menuDropdownBtn">
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/categoria"><i class="fas fa-list-alt mr-2"></i> Categoria</a></li>
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/produto"><i class="fas fa-box-open mr-2"></i> Produto</a></li>
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario"><i class="fas fa-user-circle mr-2"></i> Usuário</a></li>
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/foto"><i class="fas fa-image mr-2"></i> Fotos</a></li>
                <li><hr class="border-t border-gray-200 my-1"></li>
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/entrar"><i class="fas fa-sign-in-alt mr-2"></i> Login</a></li>
                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/cadastro"><i class="fas fa-user-plus mr-2"></i> Cadastro</a></li>
              </ul>
            </li>
          <?php endif; ?>
        <?php endif; ?>

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
              <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <ul id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden" aria-labelledby="userDropdownBtn">
              <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/perfil/<?= htmlspecialchars($usuarioLogado->id) ?>"><i class="fas fa-user mr-2"></i> Perfil</a></li>
              <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/creditos/<?= htmlspecialchars($usuarioLogado->id) ?>"><i class="fas fa-coins mr-2"></i> Créditos</a></li>
              <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/carrinho/listar"><i class="fas fa-shopping-cart mr-2"></i> Carrinho</a></li>
              <li><hr class="border-t border-gray-200 my-1"></li>
              <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md" href="/usuario/sair"><i class="fas fa-sign-out-alt mr-2"></i> Sair</a></li>
            </ul>
          <?php else: ?>
            <button class="flex items-center text-white hover:text-gray-200 transition duration-150 ease-in-out p-2 rounded focus:outline-none"
                    id="userDropdownBtn" type="button" onclick="toggleDropdown('userDropdown')">
              <i class="fas fa-user mr-1"></i> Usuário
              <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
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

<main class="flex-grow">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <?php
      $app = new App();
    ?>
  </div>
</main>

<footer class="text-white py-4 mt-8 bg-[#6D28D9] shadow-inner">
  <div class="container mx-auto text-center px-4">
    &copy; 2025 Key Lab. Todos os direitos reservados.
  </div>
</footer>

<script>
function toggleDropdown(id) {
  const dropdown = document.getElementById(id);
  if (dropdown) {
    document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
      if (menu.id !== id && !menu.classList.contains('hidden')) {
        menu.classList.add('hidden');
      }
    });
    dropdown.classList.toggle('hidden');
  }
}

document.addEventListener('click', function(event) {
  const isDropdownButton = event.target.closest('[id$="DropdownBtn"]');
  const isDropdownMenu = event.target.closest('[id$="Dropdown"]');
  if (!isDropdownButton && !isDropdownMenu) {
    document.querySelectorAll('.relative > ul').forEach(menu => {
      menu.classList.add('hidden');
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.relative > ul').forEach(menu => {
    menu.classList.add('dropdown-menu-custom');
  });

  const toggleButton = document.getElementById('navbar-toggle');
  const navBar = document.getElementById('navbarNav');

  if (toggleButton && navBar) {
    toggleButton.addEventListener('click', () => {
      navBar.classList.toggle('hidden');
      const isExpanded = navBar.classList.contains('hidden') ? 'false' : 'true';
      toggleButton.setAttribute('aria-expanded', isExpanded);
    });
  }
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/assets/js/code.js"></script>
</body>
</html>
