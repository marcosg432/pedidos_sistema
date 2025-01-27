<?php
require './app/Entity/Produtos.php';

$nome = "x-tudo";
$preco = "R$30.00";

$prod = new Produtos($nome,$preco);

// CHAMA O METODO PARA CADASTRAR O PRODUTO
$prod->cadastrar();

//VARIAVEL QUE CONTEM UM ARRAY RETORNADO DO BANCO DE DADOS
$result = $prod->buscar();

foreach ($result as $produto){
    echo "<br>" . $produto ['id'] . ' ' .$produto['nome'];
}
?>