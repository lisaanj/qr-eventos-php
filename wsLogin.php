 <?php
include_once dirname(__FILE__) . '/Classes/Usuario.php';
include_once dirname(__FILE__) . './Classes/Obra.php';
$metodo = $_SERVER["REQUEST_METHOD"];

if ($metodo == "POST") {
    $json = json_decode(file_get_contents("php://input"));

    $email=$json->{"email"};
    $senha=$json->{"senha"};

    $usuario = Usuario::logar($email, $senha);

    $reposta = array("itens" => array($usuario));
    echo json_encode($reposta);

}
//elseif ($metodo == "GET") {
//    $pegaID = explode("?", $_SERVER["REQUEST_URI"]);
//        $id = $pegaID[count($pegaID) - 1];
//
//        $obra = Obra::buscarPorObra($id);
//
//        $reposta = array("itens" => $obra);
//        echo json_encode($reposta);
//}

