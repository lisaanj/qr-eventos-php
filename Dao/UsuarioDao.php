<?php
include_once dirname(__FILE__).  '/Conexao.php';    
class UsuarioDao{
    
    public static function salvar( $nome, $nickname, $sexo, $email,
             $senha, $descricao, $dataNascimento, $foto){        
//        echo $sql;
        
        $sql = "INSERT INTO usuario(`nome`, `nickname`, `sexo`,"
                . "`email`, `senha`, `descricao`, `dataNascimento`, `idFoto`)"
                    . "Values('$nome', '$nickname', '$sexo',"
                . "'$email', '$senha', '$descricao', '$dataNascimento','$foto');";
        return Conexao::executar($sql);
    }
    public static function buscar(){
        
        $sql= "Select u.*, f.foto FROM usuario as u left join foto as f on f.idFoto = u.idFoto;";
        return Conexao::executar($sql);
    }
    public static function delete($id){
     
        $sql= "DELETE FROM Usuario WHERE id=$id;";
        return Conexao::executar($sql);
    }
    public static function logar($email, $senha){
        $sql= "Select u.*, f.foto FROM usuario as u left join foto as f on f.idFoto = u.idFoto "
                . "where (u.email = '$email' or u.nickname = '$email') and u.senha = '$senha';";
       
        return Conexao::executar($sql);
    }
    
    public static function buscarPorId($id){
        
        $sql= "SELECT * FROM Usuario WHERE id=$id;";
        return Conexao::executar($sql);
    }
}
