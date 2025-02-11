<?php

require 'models/Produtos.php';

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

  
    $produto = new Produtos();
    $produto->id = $id;

    // Chama o método excluir para deletar o produto
    if ($produto->excluir()) {
        echo '<script> alert("Produto excluído com sucesso!") </script>';
        header('Location: cadastarProduto.php');
        exit;
    } else {
        echo 'Erro ao excluir produto!';
    }
} else {
    echo 'Produto não encontrado!';
}

?>
