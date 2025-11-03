<style>
  body {
    background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e0d3f2, #f0e6ff);
    font-family: 'Inter', sans-serif;
    min-height: 100vh;
  }
  .card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 20px rgba(0,0,0,0.07);
    background: #f8faff;
  }
  .card-title {
    color: #5a2e91;
    font-weight: 600;
  }
  .btn-primary {
    background-color: #9c27b0;
    border-color: #9c27b0;
  }
  .btn-primary:hover {
    background-color: #2196f3;
    border-color: #2196f3;
  }
  .badge.bg-secondary {
    background-color: #e0d3f2;
    color: #5a2e91;
  }
  .card-footer {
    background: #e6f0ff;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
  }
</style>
<div class="container mt-4">
  <h2 class="mb-4 card-title text-center">Produtos no Carrinho</h2>
  <?php
    // Agrupa produtos pelo id e soma quantidade
    $produtosAgrupados = [];
    if (!empty($data['produtos'])) {
      foreach ($data['produtos'] as $produto) {
        $id = $produto['id'];
        if (!isset($produtosAgrupados[$id])) {
          $produtosAgrupados[$id] = $produto;
          $produtosAgrupados[$id]['quantidade_carrinho'] = 1;
        } else {
          $produtosAgrupados[$id]['quantidade_carrinho']++;
        }
      }
    }
  ?>
  <?php if (!empty($produtosAgrupados)): ?>
    <?php foreach ($produtosAgrupados as $produto): ?>
      <div class="card shadow mx-auto mb-4" style="max-width: 900px; width: 100%;">
        <div class="row g-0">
          <div class="col-md-5 d-flex align-items-center justify-content-center p-4">
            <img src="/uploads/produto/<?= htmlspecialchars($produto['imagem']) ?>"
                 class="rounded shadow-sm img-fluid"
                 style="max-height: 180px; width: auto; object-fit: contain;">
          </div>
          <div class="col-md-7 p-4">
            <h6 class="badge bg-secondary"><?= htmlspecialchars($produto['categoria']) ?></h6>
            <h2 class="mb-3 card-title"><?= htmlspecialchars($produto['nome']) ?></h2>
            <p class="mb-3"><?= htmlspecialchars($produto['descricao']) ?></p>
            <h4 class="fw-bold text-primary mb-4">R$ <?= htmlspecialchars(number_format($produto['preco'], 2, ',', '.')) ?></h4>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-secondary">Qtd: <?= htmlspecialchars($produto['quantidade_carrinho']) ?></span>
              <a href="/carrinho/remover/<?= $produto['id'] ?>" class="btn btn-danger btn-sm">Remover</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <div class="card-footer d-flex justify-content-between align-items-center">
          <span class="fw-bold">Total: R$ <?= htmlspecialchars(number_format($data['total'], 2, ',', '.')) ?></span>
          <a href="/compra/finalizar" class="btn btn-primary btn-lg">Finalizar Compra</a>
        </div>
      <?php else: ?>
        <div class="alert alert-warning m-4">Nenhum produto no carrinho.</div>
      <?php endif; ?>
      <?php if (!empty($data['msg'])): ?>
        <div class="alert alert-info mt-3 mx-4">
          <?= htmlspecialchars($data['msg']) ?>
        </div>
      <?php endif; ?>
      </div>
</div>