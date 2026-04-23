 <?php

class Conexao{
    
    private $servidor = "localhost";
    private $banco = "qreventos";
    private $usuario = "root";
    private $senha = "";
    
    //Conecta usando MySQL
    private function getConexao(){
        return new mysqli($this->servidor, $this->usuario, $this->senha, $this->banco);
    }
    
    public static function executar($sql){
        $obj = new Conexao();
        $con = $obj->getConexao();
        $con->query("SET NAMES 'utf8'");
        $resultado = $con->query($sql);
        if($resultado === TRUE){
            $resultado = $con->insert_id;
        }
        $con->close();
        return $resultado;
    }
}   