<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'auth.php';

verificarLogin(); // Verifica se usuário está logado

// Parâmetros de paginação e ordenação
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$ordenacao = isset($_GET['ordem']) ? $_GET['ordem'] : 'nome';
$direcao = isset($_GET['direcao']) ? $_GET['direcao'] : 'ASC';

// Processar logout
if (isset($_GET['logout'])) {
    fazerLogout();
}

// ... (manter o código de processamento das buscas)

// Se não houver busca específica, usar listagem paginada
if (empty($resultados)) {
    $dadosPaginados = listarProdutosPaginados($pagina, 10, $ordenacao, $direcao);
    $resultados = $dadosPaginados['produtos'];
    $totalPaginas = $dadosPaginados['paginas'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- ... (manter os estilos anteriores) ... -->
    <style>
        /* Adicionar estilos para paginação */
        .paginacao {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }
        
        .paginacao a {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
        }
        
        .paginacao a.atual {
            background-color: #007bff;
            color: white;
        }
        
        /* Estilo para as imagens dos produtos */
        .produto-imagem {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        
        /* Barra superior */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #f8f9fa;
            margin-bottom: 20px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="user-info">
            <span>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?></span>
            <?php if ($_SESSION['nivel'] === 'admin'): ?>
                <span>(Administrador)</span>
            <?php endif; ?>
        </div>
        <a href="?logout=1"><button>Sair</button></a>
    </div>

    <!-- ... (manter o código do formulário de adição/edição) ... -->
    <!-- Atualizar o formulário para incluir upload de imagem -->
    <form action="crud.php" method="POST" enctype="multipart/form-data">
        <!-- ... (campos existentes) ... -->
        <div class="form-group">
            <label>Imagem do Produto:</label>
            <input type="file" name="imagem" accept="image/*">
        </div>
        <!-- ... (resto do formulário) ... -->
    </form>

    <!-- ... (manter o código das buscas) ... -->

    <div class="container">
        <h2>Lista de Produtos</h2>
        
        <!-- Ordenação -->
        <div class="ordenacao">
            Ordenar por: 
            <a href="?ordem=nome&direcao=<?php echo $direcao === 'ASC' ? 'DESC' : 'ASC'; ?>">Nome</a> |
            <a href="?ordem=preco&direcao=<?php echo $direcao === 'ASC' ? 'DESC' : 'ASC'; ?>">Preço</a> |
            <a href="?ordem=quantidade_estoque&direcao=<?php echo $direcao === 'ASC' ? 'DESC' : 'ASC'; ?>">Estoque</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Tamanho</th>
                    <th>Cor</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $produto): ?>
                <tr>
                    <td>
                        <?php if (!empty($produto['imagem'])): ?>
                            <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>" class="produto-imagem">
                        <?php else: ?>
                            <img src="placeholder.png" alt="Sem imagem" class="produto-imagem">
                        <?php endif; ?>
                    </td>
                    <!-- ... (outras colunas) ... -->
                    <td class="actions">
                        <?php if ($_SESSION['nivel'] === 'admin'): ?>
                            <a href="index.php?editar=<?php echo $produto['id']; ?>">
                                <button type="button" class="edit">Editar</button>
                            </a>
                            <form method="POST" action="crud.php" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                                <button type="submit" name="excluir_produto" class="delete" 
                                        onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                    Excluir
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Paginação -->
        <?php if (isset($totalPaginas) && $totalPaginas > 1): ?>
        <div class="paginacao">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="?pagina=<?php echo $i; ?>&ordem=<?php echo $ordenacao; ?>&direcao=<?php echo $direcao; ?>" 
                   class="<?php echo $pagina === $i ? 'atual' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>