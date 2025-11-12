<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome (para ícones) -->
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
                        'brand-purple-start': '#6B21A8', // roxo mais escuro
                        'brand-purple-end': '#A855F7',   // roxo mais claro
                        'brand-ring': '#C084FC',         // cor para o anel de foco
                    },
                }
            }
        }
    </script>
    <style>
        /* Gradiente de fundo do body */
        body {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e0d3f2, #f0e6ff);
            min-height: 100vh;
            /* Adiciona uma sutil animação de fundo para modernidade */
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
<body class="font-sans flex items-center justify-center min-h-screen p-4">

<div class="mx-auto w-full max-w-sm">
    <!-- Card principal com efeito glassmorphism suave -->
    <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 
                transform transition duration-500 hover:shadow-3xl border border-gray-100">
        
        <div class="text-center mb-8">
            <!-- Ícone e Título -->
            <i class="fas fa-lock text-brand-purple-start text-3xl mb-3"></i>
            <h5 class="text-3xl font-extrabold text-gray-800">Login</h5>
            <p class="text-gray-500 text-sm mt-1">Acesse sua conta</p>
        </div>
        
        <form action="/usuario/entrar" method="post">
            <!-- Alerta de erro (replicando .alert.alert-danger) -->
            <?php if (isset($data['erro'])): ?>
                <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl relative mb-6 text-sm" role="alert">
                    <?= htmlspecialchars($data['erro']) ?>
                </div>
            <?php endif; ?>
            
            <!-- Campo Email -->
            <div class="mb-4">
                <label for="txt_email" class="block text-sm font-medium text-gray-700 mb-2">Email:</label>
                <input 
                    type="text" 
                    id="txt_email" 
                    name="txt_email" 
                    class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-brand-ring focus:border-brand-purple-end transition duration-200 shadow-sm" 
                    required
                >
            </div>
            
            <!-- Campo Senha -->
            <div class="mb-6">
                <label for="txt_senha" class="block text-sm font-medium text-gray-700 mb-2">Senha:</label>
                <input 
                    type="password" 
                    id="txt_senha" 
                    name="txt_senha" 
                    class="w-full border border-gray-300 p-3 rounded-xl focus:ring-2 focus:ring-brand-ring focus:border-brand-purple-end transition duration-200 shadow-sm text-black" 
                    required
                >
            </div>
            
            <!-- Botões -->
            <div class="flex space-x-4">
                <!-- Botão Entrar (com gradiente e efeito hover) -->
                <div class="w-1/2">
                    <button 
                        type="submit" 
                        class="w-full px-4 py-3 text-white font-semibold rounded-xl shadow-lg 
                                bg-gradient-to-r from-brand-purple-start to-brand-purple-end 
                                hover:from-brand-purple-end hover:to-brand-purple-start 
                                transform hover:scale-[1.03] transition duration-300 ease-in-out text-base">
                        Entrar
                    </button>
                </div>
                <!-- Botão Cadastra-se (como link com o mesmo estilo) -->
                <div class="w-1/2">
                    <a 
                        href="/usuario/cadastro/" 
                        class="block text-center w-full px-4 py-3 text-white font-semibold rounded-xl shadow-lg 
                                bg-gradient-to-r from-brand-purple-start to-brand-purple-end 
                                hover:from-brand-purple-end hover:to-brand-purple-start 
                                transform hover:scale-[1.03] transition duration-300 ease-in-out text-base">
                        Cadastra-se
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>