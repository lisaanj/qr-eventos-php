<?php

include_once dirname(__FILE__) . '/Classes/Usuario.php';
include dirname(__FILE__). './foto.php';
$metodo = $_SERVER["REQUEST_METHOD"];
//echo 'oi';
switch ($metodo) {
    case "POST":
        $json = json_decode(file_get_contents("php://input"));

        $usuario = new Usuario();
        $usuario->setNome($json->{"nome"});
        $usuario->setNickname($json->{"nickname"});
        $usuario->setSexo($json->{"sexo"});
        $usuario->setEmail($json->{"email"});
        $usuario->setSenha($json->{"senha"});
        $usuario->setDescricao($json->{"descricao"});
        $usuario->setDataNascimento($json->{"dataNascimento"});
        $usuario->setFoto(saveImage($json->{"foto"}, $json->{"nickname"}));
        $usuario->salvar();
        $jsonRetorno = array("itens" => $usuario->getId());
        echo json_encode($jsonRetorno);
        break;
    case "GET":
        $jsonArray = array();

        $where = "";
        $pegaID = explode("?", $_SERVER["REQUEST_URI"]);
        $id = $pegaID[count($pegaID) - 1];
        if(is_numeric($id)){
            $where = "where id=$id";
        }
        
        $dados = Usuario::buscar();

        while ($row = $dados->fetch_assoc()) {

            $bancoLinha = array(
                "id" => $row["id"],
                "nome" => $row["nome"],
                "nickname" => $row["nickname"],
                "sexo" => $row["sexo"],
                "email" => $row["email"],
                "senha" => $row["senha"],
                "descricao" => $row["descricao"],
                "foto" => $row["foto"],
                "dataNascimento" => $row["dataNascimento"]);
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

        $id = $pegaID[count($pegaID) - 1];
        Usuario::delete($id);
        break;
}