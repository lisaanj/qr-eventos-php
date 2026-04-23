<?php
include_once dirname(__FILE__).  '/Conexao.php';    
    class ObraDao{
        
        public static function salvar($nomeObra, $preco,
                $largura, $altura, $descricao, 
                $dataObra, $idArtista) {
            
            $sql= "INSERT INTO obra (nomeObra, preco,"
                    . "largura, altura, descricao, "
                    . "dataObra, idArtista) "
                        . "values('$nomeObra', '$preco',"
                    . "'$largura', '$altura', '$descricao',"
                    . "'$dataObra', '$idArtista');";
            return Conexao::executar($sql);
        }
        public static function buscarPorAtista($id){
            $sql= "SELECT * FROM obra left join foto as f on f.idFoto = obra.idFoto where idArtista = '$id'";
//            echo $sql;
            return Conexao::executar($sql);
        }
        public static function buscarPorObra($id){
            $sql= "SELECT * FROM obra where idObra=$id";
            return Conexao::executar($sql);
        }

        public static function delete($idObra){
            $sql="DELETE FROM obra left join foto as f on f.idFoto = obra.idFoto WHERE idObra=$idObra;";
            return Conexao::executar($sql);
        }
        
    }