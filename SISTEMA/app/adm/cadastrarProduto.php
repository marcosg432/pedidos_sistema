<?php

require 'models/Produtos.php';  

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    // Agora o objeto 'Produto' é criado com as propriedades recebendo os valores
    $produto = new Produtos($nome, (float)$preco);  
    $result = $produto->cadastrar(); 

    if($result){
        echo '<script> alert("Produto cadastrado com sucesso") </script> ';
    }else{
        echo 'ERROR';
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
</head>
<body>
    <form method="POST">
        <label for="nome">Nome do Produto</label>
        <input type="text" name="nome" id="nome" required>

        <label for="preco">Preço</label>
        <input type="number" name="preco" id="preco" step="0.01" min="0" required>

        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>

    <br>

    <table>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Preço</td>
            <td>Editar</td>
            <td>Excluir</td>
        </tr>
    
    <?php
     // Aqui a listagem dos produtos já cadastrados
     $dados = new Produtos('', 0);  
     $produtos_banco = $dados->buscar();

     foreach($produtos_banco as $produto){
        echo '
        <tr>
            <td>' .$produto['id'].' </td>
            <td>'.$produto['nome'].' </td>
            <td>' .'R$ ' . number_format($produto['preco'], 2, ',', '.') .'</td> 
            <td> <a href="editarProduto.php?id=' .$produto['id'] .'"> Editar</a> </td>
            <td> <a href="excluirProduto.php?id=' .$produto['id'] .'"> Excluir</a> </td>
        </tr>';
     }
    ?>
    </table>
</body>
</html>
