<?php

class Database{
    private $conn;
    public string $local="10.38.0.104";
    public string $db="crudpedidos";
    public string $user="devweb";
    public string $password="suporte@22";
    public $table;

    public function __construct($table = null){
        $this->table = $table;
        // echo "<br> Bom dia ";
        // echo $this->table;
         $this->conecta();
    }

    private function conecta(){
        try {
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=$this->db",$this->user,$this->password); 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            // return true;

            echo "Conectado com Sucesso!!";
        }
        catch (PDOException $err) {
            //retirar msg em produção
            die("Conexao falhada " . $err->getMessage());
        }

    }

    public function execute($query,$binds = []){
        //BINDS = parametros
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;

        }catch (PDOException $err) {
            //retirar msg em produção
            die("Connection Failed " . $err->getMessage());
        }

    }
    public function insert($values){
        //Dados query $fields=campos $binds=parametros
        $fields = array_keys($values);
        //$data = array_values($values); TESTE DE RECEBIMENTO
        $binds = array_pad([],count($fields),'?');

          //Montar query
        $query = 'INSERT INTO ' . $this->table .'  (' .implode(',',$fields). ') VALUES (' .implode(',',$binds).')';
        $this->execute($query,array_values($values));
        
    }

    public function select($where = null,$order = null, $limit = null, $fields = '*'){
        // montando a query
        $where = strlen($where) ? 'WHERE ' . $where : '' ;
        $order = strlen($order) ? 'ORDER BY ' . $order : '' ;
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '' ;

        $query = 'SELECT ' . $fields . 'FROM ' . $this->table . '' . $where;
          
        return $this->execute($query);

    }

    public function delete($where){
        $sql = 'DELETE FROM '.$this->table. ' WHERE ' .$where;
        $result = $this->execute($sql);

        if($result == true){
            return true;
        }else{
            return false;
        }

    }
    public function update($where,$values){
        $fields = array_keys($values);
        
        // MONTAR QUERY
        $query = 'UPDATE' . $this->table . 'SET' . implode('=?,',$fields). '=? WHERE' . $where;
        
        $result = $this->execute($query,array_values($values));
        return true;

    }
   

}

?>