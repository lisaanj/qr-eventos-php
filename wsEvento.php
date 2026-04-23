<?php

include_once dirname(__FILE__) . '/Classes/Evento.php';
include dirname(__FILE__) . './foto.php';
$metodo = $_SERVER["REQUEST_METHOD"];
//$metodo = "POST";
switch ($metodo) {
    case "POST":
        $json = json_decode(file_get_contents("php://input"));
//        $bal = '{"nomeEvento": "nomezera","id":0,"idOrganizado":0,"local":"IFRN","descricao":"jifafijai",
//            "dataHora":"02\/34\/2009"}';
//        $json -> JSON;
        $evento = new Evento();
        $evento->setNomeEvento($json->{"nomeEvento"});
        $evento->setLocal($json->{"local"});
        $evento->setDataHora($json->{"dataHora"});
        $evento->setDescricao($json->{"descricao"});
        $evento->setLogo(saveImage($json->{"logo"}, $json->{"nomeEvento"}));
        $evento->setIdOrganizador($json->{"idOrganizador"});
        $evento->salvar();

        $jsonRetorno = array("id" => $evento->getIdEvento());
        echo json_encode($jsonRetorno);

        break;

    case "GET":

        $jsonArray = array();
        $dados = Evento::buscar();

        while ($row = $dados->fetch_assoc()) {

            $bancoLinha = array(
                "idEvento" => $row["idEvento"],
                "nomeEvento" => $row["nomeEvento"],
                "local" => $row["local"],
                "dataHora" => $row["dataHora"],
                "descricao" => $row["descricao"],
                "logo" => $row["foto"],
                "idOrganizador" => $row["idOrganizador"]);
            $jsonArray[] = $bancoLinha;
        }

        $jsonObj = array("itens" => $jsonArray);
        echo json_encode($jsonObj);

        break;
    case "PUT":
        echo "PUT";

        break;
    case "DELETE":
        $pegaID = explode("/", $_SERVER["REQUEST_URI"]);

        $idEvento = $pegaID[count($pegaID - 1)];
        Evento::delete($idEvento);
        break;
}