<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome (Embora não usado neste snippet, é bom ter se o projeto precisar) -->
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
                        // Cores personalizadas baseadas no seu CSS original
                        'primary-purple': '#9c27b0', // Cor principal do botão
                        'primary-hover': '#2196f3',  // Cor de hover do botão
                        'text-purple': '#5a2e91',   // Cor do título
                        'card-bg': '#f8faff',        // Fundo do card
                    },
                }
            }
        }
    </script>
    <style>
        /* Gradiente de fundo do body, replicando o estilo original */
        body {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e0d3f2, #f0e6ff);
            min-height: 100vh;
        }
    </style>
</head>
<body class="font-sans flex items-center justify-center min-h-screen">

<div class="mx-auto p-4 w-full max-w-sm">
    <!-- Card principal, replicando .card e .shadow -->
    <div class="bg-card-bg rounded-xl shadow-xl p-6">
        <div class="card-body">
            <!-- Título, replicando .card-title -->
            <h5 class="text-2xl font-semibold text-text-purple mb-6 text-center">Login</h5>
            
            <form action="/usuario/entrar" method="post">
                <!-- Alerta de erro (replicando .alert.alert-danger) -->
                <?php if (isset($data['erro'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <?= htmlspecialchars($data['erro']) ?>
                    </div>
                <?php endif; ?>
                
                <!-- Campo Usuário -->
                <div class="mb-4">
                    <label for="txt_email" class="block text-sm font-medium text-gray-700 mb-1">Usuário:</label>
                    <input 
                        type="text" 
                        id="txt_email" 
                        name="txt_email" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" 
                        required
                    >
                </div>
                
                <!-- Campo Senha -->
                <div class="mb-6">
                    <label for="txt_senha" class="block text-sm font-medium text-gray-700 mb-1">Senha:</label>
                    <input 
                        type="password" 
                        id="txt_senha" 
                        name="txt_senha" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" 
                        required
                    >
                </div>
                
                <!-- Botões (replicando .row e .col-6) -->
                <div class="flex space-x-4">
                    <!-- Botão Entrar -->
                    <div class="w-1/2">
                        <button type="submit" class="w-full px-4 py-2 bg-primary-purple text-white font-medium rounded-lg shadow-md hover:bg-primary-hover transition duration-150 text-sm">
                            Entrar
                        </button>
                    </div>
                    <!-- Botão Cadastra-se -->
                    <div class="w-1/2">
                        <!-- Usando a mesma classe de estilo do btn-primary, como no original -->
                        <a href="/usuario/cadastro/" class="block text-center w-full px-4 py-2 bg-primary-purple text-white font-medium rounded-lg shadow-md hover:bg-primary-hover transition duration-150 text-sm">
                            Cadastra-se
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
