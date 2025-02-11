<?php

require_once '../models/Produtos.php';

class ProdutoController {


    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];

            $produto = new Produtos();
            $produto->nome = $nome;
            $produto->preco = $preco;

            // Chama o método de cadastro do modelo
            if ($produto->cadastrar()) {
                echo "Produto cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar produto.";
            }
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];

            $produto = new Produtos();
            $produto->id = $id;
            $produto->nome = $nome;
            $produto->preco = $preco;

            if ($produto->editar_produto()) {
                echo "Produto editado com sucesso!";
            } else {
                echo "Erro ao editar produto.";
            }
        }
    }

    public function excluir() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $produto = new Produtos();
            if ($produto->excluir($id)) {
                echo "Produto excluído com sucesso!";
            } else {
                echo "Erro ao excluir produto.";
            }
        }
    }


    public function listar() {
        $produtos = Produtos::buscar();
        foreach ($produtos as $produto) {
            echo "ID: " . $produto['id'] . " - Nome: " . $produto['nome'] . " - Preço: " . $produto['preco'] . "<br>";
        }
    }

}

?>
