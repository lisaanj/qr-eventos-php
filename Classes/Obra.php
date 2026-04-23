<?php

include_once dirname(__FILE__) . '/../Dao/ObraDao.php';
include_once dirname(__FILE__) . '/../Dao/UsuarioDao.php';

class Obra {

    public $idObra;
    public $obraFoto;
    public $nomeObra;
    public $preco;
    public $descricao;
    public $altura;
    public $largura;
    public $dataObra;
    public $idArtista;
    public $caminho;
    public $nomeArtista;
    
    function getCaminho() {
        return $this->caminho;
    }

    function getNomeArtista() {
        return $this->nomeArtista;
    }

    function setCaminho($caminho) {
        $this->caminho = $caminho;
    }

    function setNomeArtista($nomeArtista) {
        $this->nomeArtista = $nomeArtista;
    }

        function getIdObra() {
        return $this->idObra;
    }

    function getObraFoto() {
        return $this->obraFoto;
    }

    function getNomeObra() {
        return $this->nomeObra;
    }

    function getPreco() {
        return $this->preco;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getAltura() {
        return $this->altura;
    }

    function getLargura() {
        return $this->largura;
    }

    function getDataObra() {
        return $this->dataObra;
    }

    function getIdArtista() {
        return $this->idArtista;
    }

    //start set method

    function setObraFoto($obraFoto) {
        $this->obraFoto = $obraFoto;
    }

    function setNomeObra($nomeObra) {
        $this->nomeObra = $nomeObra;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

    function setIdObra($idObra) {
        $this->idObra = $idObra;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setLargura($largura) {
        $this->largura = $largura;
    }

    function setDataObra($dataObra) {
        $this->dataObra = $dataObra;
    }

    function setIdArtista($idArtista) {
        $this->idArtista = $idArtista;
    }

    function salvar() {
        $this->idObra = ObraDao::salvar($this->nomeObra,   $this->preco,
                $this->largura, $this->altura, $this->descricao, $this->dataObra, $this->idArtista);
        return $this->idObra;
    }

    public static function buscar($id) {
        $tabela = ObraDao::buscarPorAtista($id);
        $obras = array();
        if ($tabela != null) {
            while ($linha = $tabela->fetch_assoc()) {
                $obra = new Obra();
                $obra->setIdObra($linha["idObra"]);
                $obra->setObraFoto($linha["idFoto"]);
                $obra->setPreco($linha["preco"]);
                $obra->setNomeObra($linha["nomeObra"]);
                $obra->setDescricao($linha["descricao"]);
                $obra->setAltura($linha["altura"]);
                $obra->setLargura($linha["largura"]);
                $obra->setIdArtista($linha["idArtista"]);
                $obra->setDataObra($linha["dataObra"]);
                $obras[] = $obra;
            }
        }
        return $obras;
    }
    public static function buscarPorObra($id) {
        $tabela = ObraDao::buscarPorObra($id);
         $obras = array();
        if ($tabela != null) {
            while ($linha = $tabela->fetch_assoc()) {
                $obra = new Obra();
                $obra->setIdObra($linha["idObra"]);
                $obra->setObraFoto($linha["idFoto"]);
                $obra->setPreco($linha["preco"]);
                $obra->setNomeObra($linha["nomeObra"]);
                $obra->setDescricao($linha["descricao"]);
                $obra->setAltura($linha["altura"]);
                $obra->setLargura($linha["largura"]);
                $obra->setIdArtista($linha["idArtista"]);
                $obra->setDataObra($linha["dataObra"]);
                $obras[] = $obra;
            }
        }
        return $obras;
    }

    public static function delete($idObra) {
        return ObraDao::delete($idObra);
    }

}
