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
        $this->conecta();
    }

    private function conecta(){
        try {
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=$this->db",$this->user,$this->password); 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            echo "Conectado com Sucesso!!";
        }
        catch (PDOException $err) {
            die("Conexao falhada " . $err->getMessage());
        }
    }

    public function execute($query, $binds = []){
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;
        } catch (PDOException $err) {
            die("Connection Failed " . $err->getMessage());
        }
    }

    public function insert($values){
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        $query = 'INSERT INTO ' . $this->table .'  (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        $this->execute($query, array_values($values));
    }

    public function select($where = null, $params = [], $order = null, $limit = null, $fields = '*'){
        // Montando a query com placeholders
        $where = $where ? 'WHERE ' . $where : '';
        $order = $order ? 'ORDER BY ' . $order : '';
        $limit = $limit ? 'LIMIT ' . $limit : '';
    
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;
        
        $stmt = $this->execute($query, $params);
        return $stmt;
    }
    
    

    public function delete($where){
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        $result = $this->execute($sql);
        return $result ? true : false;
    }

    public function update($where, $values){
        $fields = array_keys($values);
        $query = 'UPDATE ' . $this->table . ' SET ' . implode(' = ?, ', $fields) . ' = ? WHERE ' . $where;
        $this->execute($query, array_values($values));
        return true;
    }
}

?>
