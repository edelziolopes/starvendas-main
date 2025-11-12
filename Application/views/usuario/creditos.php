<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
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
                        // Cores personalizadas consistentes com o Canvas de Cadastro
                        'primary-purple': '#9c27b0', // Cor principal do botão
                        'primary-hover': '#2196f3',  // Cor de hover do botão
                        'text-purple': '#5a2e91',   // Cor do título
                        'card-bg': '#f8faff',        // Fundo do card
                        'badge-bg': '#e0d3f2',       // Fundo do badge (similar ao .bg-secondary)
                        'badge-text': '#5a2e91',     // Texto do badge
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
<!-- Centralização vertical e horizontal -->
<body class="font-sans flex items-center justify-center min-h-screen px-4 py-8">

<!-- Container centralizado com largura máxima (600px no original, aqui max-w-xl) -->
<div class="w-full max-w-xl mx-auto">
    
    <?php if (!empty($data['creditos'])): ?>
    
    <!-- Card principal, replicando .card e .shadow -->
    <div class="bg-card-bg rounded-xl shadow-2xl w-full transition duration-300 text-black">

        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Créditos do Usuário</h2>
            <p class="text-gray-700">Aqui estão os detalhes dos créditos do usuário:</p>
            <ul class="list-disc list-inside">
                <?php foreach ($data['creditos'] as $credito): ?>
                    <li><?=$credito['nome'] ?> - <strong><?= htmlspecialchars($credito['creditos']) ?> pontos</strong></li>
                <?php endforeach; ?>
            </ul>
        </div>



        

        <!-- Mensagem de Sucesso (Replica .alert .alert-success) -->
        <?php if (isset($_GET['msg'])): ?>
            <div class="p-4 m-6 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm" role="alert">
                <p><i class="fas fa-check-circle mr-2"></i> <?= htmlspecialchars($_GET['msg']) ?></p>
            </div>
        <?php endif; ?>
        
    
    
        <?php else: ?>
            <!-- Mensagem de erro caso o usuário não seja encontrado -->
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm" role="alert">
                <p class="font-bold">Erro!</p>
                <p>Os dados do usuário não puderam ser carregados.</p>
            </div>
        <?php endif; ?>

</div>

</body>
</html>
