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
<!-- A classe "flex items-center justify-center min-h-screen" garante a centralização vertical e horizontal -->
<body class="font-sans flex items-center justify-center min-h-screen px-4 py-8">

<!-- Container centralizado com largura máxima e margin auto horizontal -->
<div class="w-full max-w-sm mx-auto">
    <!-- Card principal, replicando .card e .shadow -->
    <div class="bg-card-bg rounded-xl shadow-xl p-6">
        <div class="card-body">
            <!-- Título, replicando .card-title -->
            <h5 class="text-2xl font-semibold text-text-purple mb-6 text-center">Cadastro de Usuário</h5>
            
            <form action="/usuario/cadastrar" method="post" enctype="multipart/form-data">
                
                <!-- Campo Nome -->
                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome:</label>
                    <input 
                        type="text" 
                        id="nome" 
                        name="txt_nome" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" 
                        required
                    >
                </div>
                
                <!-- Campo E-mail -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail:</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="txt_email" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" 
                        required
                    >
                </div>
                
                <!-- Campo Senha -->
                <div class="mb-4">
                    <label for="senha" class="block text-sm font-medium text-gray-700 mb-1">Senha:</label>
                    <input 
                        type="password" 
                        id="senha" 
                        name="txt_senha" 
                        class="w-full border border-gray-300 p-2 rounded-lg focus:ring-primary-purple focus:border-primary-purple transition duration-150" 
                        required
                    >
                </div>
                
                <!-- Campo Foto (File Input) -->
                <div class="mb-6">
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto:</label>
                    <!-- Nota: File inputs geralmente precisam de estilo adicional para ficarem bonitos, 
                         mas estamos usando a classe básica do formulário para manter a equivalência. -->
                    <input 
                        type="file" 
                        id="foto" 
                        name="txt_foto" 
                        class="w-full block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                               file:rounded-full file:border-0 file:text-sm file:font-semibold
                               file:bg-primary-purple file:text-white hover:file:bg-primary-hover
                               border border-gray-300 rounded-lg cursor-pointer" 
                        accept="image/*" 
                        required
                    >
                </div>
                
                <!-- Botão Cadastrar (replicando .d-grid e .btn-primary) -->
                <div class="grid">
                    <button type="submit" class="w-full px-4 py-2 bg-primary-purple text-white font-medium rounded-lg shadow-md hover:bg-primary-hover transition duration-150 text-sm">
                        Cadastrar
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>

</body>
</html>
