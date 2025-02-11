<?php

require 'models/Produtos.php';

if (isset($_GET['id'])) {
    // Cria um objeto Produto com o ID da URL
    $produto = new Produtos('', 0);
    $produto->id = $_GET['id'];
    
    // Busca o produto no banco de dados
    $produto_banco = $produto->buscarById($_GET['id']);



    // var_dump($produto_banco);


    
    if (isset($_POST['editar'])) {
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];

        // Atualiza os dados do produto
        $produto->nome = $nome;
        $produto->preco = $preco;
        
        // Chama o método para editar o produto
        $produto->editar_produto();  

        echo '<script> alert("Produto atualizado com sucesso") </script>';
        header('Location: cadastrarProduto.php'); 
        exit;
    }
} else {
    echo 'Produto não encontrado!';
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
</head>
<body>
<form method="POST">
    <label for="nome">Nome do Produto</label>
    <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($produto_banco['nome']); ?>" required>

    <label for="preco">Preço</label>
    <input type="text" name="preco" id="preco" value="<?php echo htmlspecialchars($produto_banco['preco']); ?>" required>

    <input type="submit" name="editar" value="Editar">
</form>

</body>
</html>
