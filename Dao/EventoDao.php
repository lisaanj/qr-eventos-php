<?php

include_once dirname(__FILE__) . '/Conexao.php';

class EventoDao {

    public static function salvar($nomeEvento, $local, $dataHora, $descricao, $idOrganizador,$logo) {
        $sql = "INSERT INTO evento(`nomeEvento`, `local`,"
                . "`dataHora`, `descricao`,  `idOrganizador`,`idFoto`)"
                . "Values('$nomeEvento', '$local',"
                . " '$dataHora', '$descricao',  '$idOrganizador','$logo');";
        return Conexao::executar($sql);
    }

    public static function buscar() {

        $sql = "SELECT e.*, foto.foto FROM evento as e left join foto on foto.idFoto = e.idFoto";
        return Conexao::executar($sql);
    }

    public static function delete($idEvento) {
        $sql = "DELETE FROM Evento WHERE idEvento = $idEvento;";
        return Conexao::executar($sql);
    }

    public static function add($idObra, $idEvento) {
        $sql = "SELECT * FROM listaObras where idObras='$idObra' and idEvento='$idEvento';";
        $r1 = Conexao::executar($sql);
        if ($r1->num_rows==0) {
            $sql = "INSERT INTO listaObras(idObras,idEvento) VALUES('$idObra', '$idEvento');";
            Conexao::executar($sql);
        } else {
            $sql = "DELETE FROM listaObras WHERE idObras='$idObra' and idEvento='$idEvento';";
            Conexao::executar($sql);
        }
        return true;
    }

    public static function listar($idEvento) {
        $sql = "SELECT o.*, u.nome,f.foto FROM `obra` o left join foto as f on f.idFoto = o.idFoto,"
           . " `listaobras` lo, usuario u WHERE o.idObra =lo.idObras AND o.idArtista=u.id AND lo.idEvento = '$idEvento'";
//        echo $sql."<br>";
        return Conexao::executar($sql);
    }

}
