<?php

require_once dirname(__FILE__) . '/Classes/Obra.php';
include dirname(__FILE__) . './foto.php';

$metodo = $_SERVER["REQUEST_METHOD"];

switch ($metodo) {
    case "POST":
        //Opção para a criação de uma nova obra
        $json = json_decode(file_get_contents("php://input"));

        $obra = new Obra();
        $obra->setNomeObra($json->{"nomeObra"});
        $obra->setAltura($json->{"altura"});
        $obra->setLargura($json->{"largura"});
        $obra->setDescricao($json->{"descricao"});
        $obra->setPreco($json->{"preco"});
        $obra->setObraFoto(saveImage($json->{"obraFoto"}, $json->{"nomeObra"}));
        $obra->setIdArtista($json->{"idArtista"});
        $obra->setDataObra($json->{"dataObra"});
        $obra->salvar();

        $jsonRetorno = array("itens" => $obra->getIdObra());
        echo json_encode($jsonRetorno);

        break;
    case "GET":

        $pegaID = explode("?", $_SERVER["REQUEST_URI"]);
        $id = $pegaID[count($pegaID) - 1];

        $obra = Obra::buscar($id);

        $reposta = array("itens" => $obra);
        echo json_encode($reposta);

        break;
    case "PUT":
        echo "PUT";
        //Opção para alterar objeto
        //Ainda não implementada
        break;
    case "DELETE":
        //Opção para remoção de um objeto
        //Verifica o ID informado
        $pegaID = explode("/", $_SERVER["REQUEST_URI"]);
        $idObra = $pegaID[count($pegaID) - 1];

        //Atualmente está retornando 0
        $jsonObj = array("itens" => Obra::delete($idObra));
        echo json_encode($jsonObj);
        break;

    default:
        break;
}