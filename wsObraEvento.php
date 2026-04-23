<?php

include_once dirname(__FILE__) . '/Classes/Evento.php';
$metodo = $_SERVER["REQUEST_METHOD"];
switch ($metodo) {
    case "POST":
        $json = json_decode(file_get_contents("php://input"));

        $idObra = $json->{"idObra"};
        $idEvento = $json->{"idEvento"};

        $evento = Evento::add($idObra, $idEvento);

        $reposta = array("itens" => array($evento));
        echo json_encode($reposta);
        break;
    case "GET":
//        $json = json_decode(file_get_contents("php://input"));
//
//        $idEvento = $json->{"idEvento"};
//
//        $evento = Evento::listar($idEvento);
//
//        $reposta = array("itens" => array($evento));
//        echo json_encode($reposta);
        $pegaID = explode("?", $_SERVER["REQUEST_URI"]);
        $idEvento = $pegaID[count($pegaID) - 1];

        $obra = Evento::listar($idEvento);
       
        $reposta = array("itens" => $obra);
        echo json_encode($reposta);
}