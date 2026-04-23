<!DOCTYPE html>
<?php
include ('pdf/mpdf.php');
include_once dirname(__FILE__) . '/../Classes/Evento.php';
include_once dirname(__FILE__) . '/../Classes/Usuario.php';
//$obra = Evento::listar($json->{"idEvento"});
$obra = Evento::listar($_GET["idEvento"]);
$cont = 0;

$inicio = "<html>
                <head>
                    <meta charset='UTF-8'>
                    <link href='css.css' rel='stylesheet'>
                    <style>
                        h1{
                            font-size: 16px;
                            text-align: center;
                        }
                    </style>
                </head>
                <body>
                    <article>
                    <table style = 'width: 100%'>
                    <tr>";
foreach ($obra as $list) {
    $cont++;
    $usuario = Usuario::buscarPorId($list->getIdArtista());
    $desc ="'".$list->getDescricao()."'";
    $result =  (String) $list->getAltura().';'.$list->getLargura().';'.$list->getPreco().';'
            . $list->getDescricao().';'.$usuario->getNome().';'.$list->getNomeObra().';'
            . $list->getDataObra().'';
    
    print_r($result);
    $pagina = $pagina . "<td>"
            . "<section>"
            ."<h1><center>" .  $result . "</center></h1>"
            . "<h1><center>" . $usuario->getNome() . "</center></h1><br>"
            . "<img src ='./qr_img0.50j/php/qr_img.php?"
            . "d=" . $result."&e=H&s=4s&t=P'/>"
            . "</section>"
            . "</td>";
    if($cont==4){
        $pagina = $pagina."</tr> "
                . "<tr>";
        $cont=0;
    }
}
$fim = "</tr>    
    </table>
    </article>
                </body>
           </html>";
$arquivo = "Lista de Obras.pdf";

$mpdf = new mPDF();
$mpdf->WriteHTML($inicio . $pagina . $fim);
$mpdf->Output($arquivo, 'I');
// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário