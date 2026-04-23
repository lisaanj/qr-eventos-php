<?php

include_once dirname(__FILE__) . '/../Dao/EventoDao.php';
include_once dirname(__FILE__) . '/Obra.php';

class Evento {

    private $idEvento;
    private $nomeEvento;
    private $local;
    private $dataHora;
    private $descricao;
    private $logo;
    private $idOrganizador;

    function getIdEvento() {
        return $this->idEvento;
    }

    function getNomeEvento() {
        return $this->nomeEvento;
    }

    function getLocal() {
        return $this->local;
    }

    function getDataHora() {
        return $this->dataHora;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getLogo() {
        return $this->logo;
    }

    function getIdOrganizador() {
        return $this->idOrganizador;
    }

    //start set method

    function setNomeEvento($nomeEvento) {
        $this->nomeEvento = $nomeEvento;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setLogo($logo) {
        $this->logo = $logo;
    }

    function setIdOrganizador($idOrganizador) {
        $this->idOrganizador = $idOrganizador;
    }

    function salvar() {
        $this->idEvento = EventoDao::salvar($this->nomeEvento, $this->local,
                $this->dataHora, $this->descricao, $this->idOrganizador, $this->logo);
        return $this->idEvento;
    }

    public static function buscar() {
        return EventoDao::buscar();
    }

    public static function delete($idEvento) {
        return Evento::delete($idEvento);
    }

    public static function add($idObra, $idEvento) {
        EventoDao::add($idObra, $idEvento);
    }

    function listar($idEvento) {
        $tabela = EventoDao::listar($idEvento);
        $obras= [];
        if ($tabela != null) {
            while ($linha = $tabela->fetch_assoc()) {
                $obra = new Obra();
                $obra->setIdObra($linha["idObra"]);
                $obra->setObraFoto($linha["idFoto"]);
                $obra->setNomeObra($linha["nomeObra"]);
                $obra->setPreco($linha["preco"]);
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

}
