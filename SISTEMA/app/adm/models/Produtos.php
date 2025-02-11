<?php

require __DIR__ . '/../../../DB/Database.php';


class Produtos {
    public int $id;
    public string $nome;
    public float $preco;

    public function __construct(string $nome = '', float $preco = 0.0) {
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function cadastrar(){
        if(empty($this->nome) || !is_numeric($this->preco)) {
            echo "Erro: Nome vazio ou preço inválido.";
            return false; 
        }

        try {
            // Verificando o valor das variáveis antes de tentar inserir
            echo "Nome: " . $this->nome . " | Preço: " . $this->preco;
    
            $db = new Database('produtos');
            $db->insert([
                'nome' => $this->nome,
                'preco' => $this->preco,
            ]);
            
            echo "Produto cadastrado com sucesso!"; // Confirmação de cadastro
            return true; 
        } catch (Exception $e) {
            echo "Erro ao cadastrar produto: " . $e->getMessage();
            return false; 
        }
    }



    public function editar_produto(){
        return (new Database('produtos'))->update('id='. $this->id, [
            'nome' => $this->nome,
            'preco' => $this->preco,
        ]);
    }

    public static function buscar($where = null, $order = null, $limit = null){
        // Aqui já garantimos que o retorno da consulta é um objeto válido para o método fetchAll()
        return (new Database('produtos'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarById($id) {
        $query = "SELECT * FROM produtos WHERE id = :id";
        $stmt = (new Database('produtos'))->execute($query, [':id' => $id]); // Use o método execute
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    
    
    
    
    
    
    

    public function excluir(){
        $db = new Database('produtos');
        return $db->delete('id = ' . $this->id);
    }
}
?>
