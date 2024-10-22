<?php
// ... (manter as funções anteriores)

function uploadImagem($arquivo) {
    $diretorio = "uploads/";
    if (!file_exists($diretorio)) {
        mkdir($diretorio, 0777, true);
    }
    
    $nomeArquivo = uniqid() . '_' . basename($arquivo['name']);
    $caminhoCompleto = $diretorio . $nomeArquivo;
    
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    
    if (!in_array($extensao, $tiposPermitidos)) {
        return false;
    }
    
    if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
        return $caminhoCompleto;
    }
    
    return false;
}

// Função para paginação
function listarProdutosPaginados($pagina = 1, $porPagina = 10, $ordenacao = 'nome', $direcao = 'ASC') {
    global $pdo;
    
    $offset = ($pagina - 1) * $porPagina;
    
    try {
        // Contar total de registros
        $total = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
        
        // Buscar registros paginados
        $stmt = $pdo->prepare("SELECT * FROM produtos ORDER BY {$ordenacao} {$direcao} LIMIT :offset, :porPagina");
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':porPagina', $porPagina, PDO::PARAM_INT);
        $stmt->execute();
        
        return [
            'produtos' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $total,
            'paginas' => ceil($total / $porPagina)
        ];
    } catch (PDOException $e) {
        return false;
    }
}

// Atualizar função de adicionar produto para incluir imagem
function adicionarProduto($dados, $imagem = null) {
    global $pdo;
    
    if ($imagem && $imagem['error'] === 0) {
        $caminhoImagem = uploadImagem($imagem);
        if ($caminhoImagem) {
            $dados['imagem'] = $caminhoImagem;
        }
    }
    
    try {
        $campos = implode(', ', array_keys($dados));
        $valores = ':' . implode(', :', array_keys($dados));
        
        $stmt = $pdo->prepare("INSERT INTO produtos ({$campos}) VALUES ({$valores})");
        return $stmt->execute($dados);
    } catch (PDOException $e) {
        return false;
    }
}
?>