<?php
    require_once 'conexao.php';
    // include_once 'dashboardnutricionista.php';
    // Carregar composer
    require 'vendor/autoload.php';

    // Referenciar o namespace Dompdf
    use Dompdf\Dompdf;

    // Instaciar e usar a classe dompdf
    $dompdf = new Dompdf(['enable_remote' => True]);

    $userSelect = $_POST['id'];

    // var_dump($usuarioSelecionado);
    // // $dados = $usuarioSelecionado;

    $c = new conexao();
    $query = "SELECT * FROM tb_Usuario usuario LEFT JOIN tb_Rotina rotina ON usuario.Id_Usuario = rotina.Id_Rotina LEFT JOIN tb_Alimento alimento ON alimento.Id_Alimento = rotina.Id_Alimento WHERE usuario.Id_Usuario = '$userSelect'";

    $stms = $c->conectar()->prepare($query);
    $stms->execute();

    $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);


    $dados = "<!DOCTYPE html>";
    $dados .= "<html lang='pt-BR'>";
    $dados .= "<head>";
    $dados .= "<meta charset='UTF-8'>";
    $dados .= "<title>Relatório</title>";
    $dados .= "<link rel='stylesheet' href='http://localhost/NutriPlanner%20Tg/css/custom.css'>";
    $dados .= "</head>";
    $dados .= "<body>";
    $dados .= "<img src='http://localhost/NutriPlanner%20Tg/img/Nova%20Logo%20NutriPlanner.png'>";
    $dados .= "";
    $dados .= "<h2>Relatório Alimentar</h2>";
    $dados .= "<hr>";
    // $dados .= "<table>";
    foreach($resultado as $linha){
        $dados .= $linha['Id_Rotina']." Data Refeição: ".$linha['Data_Refeicao']."Qtde Calorias: ".$linha['Calorias']."<br>";
    }
    // $dados .= "</table>";
    $dados .= "";
    $dados .= "";
    $dados .= "<footer>";
    $dados .= "<p>Nutricionista: Gustavo Almeida</p>";
    $dados .= "</footer>";
    $dados .= "</body>";
    $dados .= "</html>";

    // Instanciar o metodo loadHTML e enviar o conteúdo do PDF
    $dompdf->loadHtml($dados);

    // Configurar o tamanho e a orientação do papel
    // Landscape - Imprime a foto em modo paisagem
    // Portrait - Imprime em moto retrato
    $dompdf->setPaper('A4',"portrait");

    // Renderiza o HTML como PDF
    $dompdf->render();

    // Gerar PDF
    $dompdf->stream();