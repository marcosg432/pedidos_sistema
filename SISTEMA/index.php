<?php
require './app/Entity/Cadastro.php';


$prod = new Produtos();
$nome = "x-burguer";
$preco = 15.00;

$prod->nome = $nome;
$prod->preco = $preco;



// CHAMA O METODO PARA CADASTRAR O PRODUTO
$prod->cadastrar();

//VARIAVEL QUE CONTEM UM ARRAY RETORNADO DO BANCO DE DADOS
$result = $prod->buscar();

foreach ($result as $produto){
    echo "<br>" . $produto ['id'] . ' ' .$produto['nome'];
}
?>