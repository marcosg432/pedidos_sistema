<?php
require './Entity/index.php'; 


if (isset($_GET['id'])) {
    $id_recebido = $_GET['id'];
    echo "ID RECEBIDO: " . $id_recebido;


    $db = new Database('produtos');

    // Busca os dados do produto
    $result = $db->select("id = $id_recebido");
    $produto = $result->fetch(PDO::FETCH_ASSOC); 

    // Verifica se o produto foi encontrado
    if ($produto) {

        ?>
        <form method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>
            <br>
            <label for="preco">Preço:</label>
            <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required>
            <br>
            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
            <input type="submit" value="Atualizar Produto">
        </form>
        <?php
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "ID do produto não fornecido.";
}

// Processa a atualização do produto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    // Atualiza o produto no banco de dados
    $db->update("id = $id", ['nome' => $nome, 'preco' => $preco]);
    echo "Produto atualizado com sucesso!";
}
?>