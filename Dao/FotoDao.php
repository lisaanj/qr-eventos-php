<?php

class FotoDao {

    public static function salvar($caminho) {
//        echo $sql;

        $sql = "INSERT INTO foto(`foto`) "
                . "Values('$caminho');";
        return Conexao::executar($sql);
    }
    public static function buscar($id){
        $sql = "select * from foto where id='$id';";
        return Conexao::executar($sql);
    }

}
