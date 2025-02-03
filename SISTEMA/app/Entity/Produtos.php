<?php

require $_SERVER['DOCUMENT_ROOT'] . '/meu_sistema/SISTEMA/DB/Database.php';


class Produtos{
    public int $id;
    public string $nome;
    public float $preco;

    public function cadastrar(){
        $db = new Database('produtos');

        $result =$db->insert(
            [
                'nome' => $this->nome,
                'preco' => $this->preco,

            ]
            );
            if($result){
                return true;
            }else{
                return false;
            }
    }
    public function editar_produto(){
        return (new Database('produtos'))->update('id='. $this->id,[
            'nome'=>$this->nome,
            'preco'=>$this->preco
        ]);
    }
    
    public static function buscar($where=null, $order=null,$limit=null){
        // FETCHALL
        return (new Database('produtos'))->select($where=null, $order=null,$limit=null)->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function buscar_by_id($id){
        // FETCHALL
        return (new Database('produtos'))->select('id='. $id)->fetchobject(self::class);
    }

    public function excluir($id) {
        $db = new Database('produtos'); 
        return $db->delete('id = ' . $id); 
    }
    
    


}
?>