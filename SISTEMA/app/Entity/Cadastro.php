<?php

require './Produtos.php';
$dados = new Produtos('','','');
$produto_banco = $dados->buscar();

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $produto = $_POST['preco'];
  

    $produto = new Produtos($nome,$preco);
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
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nome" id="nome">
        <input type="text" name="preco" id="preco">
        <input type="submit" name="cadastrar" value="Cadastrar">

    </form>

    <br>

    <table>
        <tr>
        <td>id</td>
        <td>nome</td>
        <td>preco</td>
        <td>editar</td>
        <td>excluir</td>
        </tr>
   
        <?php
      foreach($produto_banco as $produto){
        echo '
        <tr>
            <td>' .$produto['id'].' </td>
            <td>'.$produto['nome'].' </td>
            <td>' .$produto['preco'].' </td>
            <td> <a href="editar.php?id=' .$produto['id'] .'"> Editar</a> </td>
            <td> <a href="excluir.php?id=' .$produto['id'] .'"> Excluir</a> </td>
           
        </tr>';
      }

    ?>
    </table>
</body>
</html>

