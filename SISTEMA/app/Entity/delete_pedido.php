<?php

require 'Produtos.php'; 

// Criando conexão com o banco
$db = new Database('produtos');

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $produto = new Produtos(); 

    // Chamar o método excluir
    if ($produto->excluir($id)) {
        echo "Produto excluído com sucesso!";
        header("Location: Cadastro.php"); // Redireciona para a listagem
        exit();
    } else {
        echo "Erro ao excluir o produto.";
    }
} else {
    echo "ID do produto não encontrado.";
}
?>
