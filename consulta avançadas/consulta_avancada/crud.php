<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicionar Produto
    if (isset($_POST['adicionar_produto'])) {
        $dados = [
            'nome' => $_POST['nome'],
            'categoria' => $_POST['categoria'],
            'tamanho' => $_POST['tamanho'],
            'cor' => $_POST['cor'],
            'preco' => $_POST['preco'],
            'quantidade_estoque' => $_POST['quantidade_estoque']
        ];
        
        if (adicionarProduto($dados)) {
            header('Location: index.php?msg=Produto adicionado com sucesso!');
        } else {
            header('Location: index.php?error=Erro ao adicionar produto');
        }
    }
    
    // Atualizar Produto
    if (isset($_POST['atualizar_produto'])) {
        $id = $_POST['id'];
        $dados = [
            'nome' => $_POST['nome'],
            'categoria' => $_POST['categoria'],
            'tamanho' => $_POST['tamanho'],
            'cor' => $_POST['cor'],
            'preco' => $_POST['preco'],
            'quantidade_estoque' => $_POST['quantidade_estoque']
        ];
        
        if (atualizarProduto($id, $dados)) {
            header('Location: index.php?msg=Produto atualizado com sucesso!');
        } else {
            header('Location: index.php?error=Erro ao atualizar produto');
        }
    }
    
    // Excluir Produto
    if (isset($_POST['excluir_produto'])) {
        $id = $_POST['id'];
        if (excluirProduto($id)) {
            header('Location: index.php?msg=Produto excluído com sucesso!');
        } else {
            header('Location: index.php?error=Erro ao excluir produto');
        }
    }
}
?>