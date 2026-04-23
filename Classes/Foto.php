<?php

include dirname(__FILE__) . '/../Dao/FotoDao.php';

class Foto {

    private $id;
    private $caminho;

    function getId() {
        return $this->id;
    }

    function getCaminho() {
        return $this->caminho;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCaminho($caminho) {
        $this->caminho = $caminho;
    }

    public static function salvarFoto($caminho) {
        return FotoDao::salvar($caminho);
    }

    public static function buscar($id) {
        $tabela = FotoDao::buscar($id);
        if ($tabela != null) {
            while ($linha = $tabela->fetch_assoc()) {
                $foto = new Foto();
                $foto->setCaminho($linha["foto"]);
                $foto->setId($linha["idFoto"]);
                return $foto;
            }
        }
    }

}
