<?php

include_once dirname(__FILE__) . '/../Dao/UsuarioDao.php';
require_once dirname(__FILE__) . '/Util.php';

class Usuario {

    public $id;
    public $nome;
    public $nickname;
    public $sexo;
    public $email;
    public $senha;
    public $descricao;
    public $foto;
    public $dataNascimento;

    //start get method
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getNickname() {
        return $this->nickname;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getFoto() {
        return $this->foto;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    //start set method

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function salvar() {
        return $this->id = UsuarioDao::salvar($this->nome, $this->nickname, $this->sexo,
                $this->email, $this->senha, $this->descricao, $this->dataNascimento, $this->foto);
    }

    public static function buscar() {
        UsuarioDao::buscar();
    }

    public static function buscarPorId($id) {
        $tabela = UsuarioDao::buscarPorId($id);
        if ($tabela != null) {
            while ($linha = $tabela->fetch_assoc()) {
                $usuario = new Usuario();
                $usuario->setDataNascimento($linha["dataNascimento"]);
                $usuario->setDescricao($linha["descricao"]);
                $usuario->setEmail($linha["email"]);
                $usuario->setNickname($linha["nickname"]);
                $usuario->setNome($linha["nome"]);
                $usuario->setSexo($linha["sexo"]);
                $usuario->setFoto($linha["idFoto"]);
                $usuario->setId($linha["id"]);
                return $usuario;
            }
        }
        return null;
    }

    public static function delete($id) {
        UsuarioDao::delete($id);
    }

    public static function logar($email, $senha) {
        $tabela = UsuarioDao::logar($email, $senha);

        if ($tabela != null) {
            while ($linha = $tabela->fetch_assoc()) {
                $usuario = new Usuario();
                $usuario->setDataNascimento($linha["dataNascimento"]);
                $usuario->setDescricao($linha["descricao"]);
                $usuario->setEmail($linha["email"]);
                $usuario->setFoto($linha["foto"]);
                $usuario->setNickname($linha["nickname"]);
                $usuario->setNome($linha["nome"]);
                $usuario->setSexo($linha["sexo"]);
                $usuario->setId($linha["id"]);
                return $usuario;
            }
        }
        return null;
    }

}
