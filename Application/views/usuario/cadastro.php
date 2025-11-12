<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Tailwind Configuration: Definindo Cores Consistentes com a Página de Login -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'brand-purple-start': '#6B21A8', // roxo mais escuro
                        'brand-purple-end': '#A855F7',   // roxo mais claro
                        'brand-ring': '#C084FC',         // cor para o anel de foco
                    },
                }
            }
        }
    </script>
    <style>
        /* Gradiente de fundo do body com animação suave */
        body {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e0d3f2, #f0e6ff);
            min-height: 100vh;
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="font-sans flex items-center justify-center min-h-screen px-4 py-8">

<!-- Container centralizado com largura máxima -->
<div class="w-full max-w-sm mx-auto">
    <!-- Card principal com efeito glassmorphism suave -->
    <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 
                transform transition duration-500 hover:shadow-3xl border border-gray-100">
        
        <div class="text-center mb-8">
            <!-- Ícone e Título -->
            <i class="fas fa-user-plus text-brand-purple-start text-3xl mb-3"></i>
            <h5 class="text-3xl font-extrabold text-gray-800">Cadastro</h5>
            <p class="text-gray-500 text-sm mt-1">Crie sua nova conta</p>
        </div>
        
        <form action="/usuario/cadastrar" method="post" enctype="multipart/form-data">
            
            <!-- Campo Nome -->
            <div class="mb-4">
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome:</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="txt_nome" 
                    placeholder="Seu nome completo"
                    class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-brand-ring focus:border-brand-purple-end transition duration-200 shadow-sm text-black" 
                    required
                >
            </div>
            
            <!-- Campo E-mail -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E-mail:</label>
                <input 
                    type="email" 
                    id="email" 
                    name="txt_email" 
                    placeholder="exemplo@dominio.com"
                    class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-brand-ring focus:border-brand-purple-end transition duration-200 shadow-sm text-black" 
                    required
                >
            </div>
            
            <!-- Campo Senha -->
            <div class="mb-4">
                <label for="senha" class="block text-sm font-medium text-gray-700 mb-2">Senha:</label>
                <input 
                    type="password" 
                    id="senha" 
                    name="txt_senha" 
                    placeholder="Mínimo 6 caracteres"
                    class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-brand-ring focus:border-brand-purple-end transition duration-200 shadow-sm text-black" 
                    required
                >
            </div>
            
            <!-- Campo Foto (File Input Estilizado) -->
            <div class="mb-6">
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto de Perfil:</label>
                <input 
                    type="file" 
                    id="foto" 
                    name="txt_foto" 
                    class="w-full block text-sm text-gray-500 
                           file:mr-4 file:py-2 file:px-4 
                           file:rounded-xl file:border-0 file:text-sm file:font-semibold
                           file:bg-brand-purple-start file:text-white hover:file:bg-brand-purple-end 
                           hover:file:shadow-md transition duration-300
                           border border-gray-300 rounded-xl cursor-pointer p-1" 
                    accept="image/*" 
                    required
                >
            </div>
            
            <!-- Botão Cadastrar (com gradiente e efeito hover) -->
            <div class="grid mb-4">
                <button 
                    type="submit" 
                    class="w-full px-4 py-3 text-white font-semibold rounded-xl shadow-lg 
                           bg-gradient-to-r from-brand-purple-start to-brand-purple-end 
                           hover:from-brand-purple-end hover:to-brand-purple-start 
                           transform hover:scale-[1.03] transition duration-300 ease-in-out text-base">
                    Cadastrar
                </button>
            </div>

            <!-- Link para Login -->
            <div class="text-center mt-4">
                <a href="/usuario/entrar" class="text-sm font-medium text-brand-purple-start hover:text-brand-purple-end transition duration-200">
                    Já tem uma conta? Faça Login
                </a>
            </div>
            
        </form>
    </div>
</div>

</body>
</html>