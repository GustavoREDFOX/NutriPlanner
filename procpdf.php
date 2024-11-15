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

    // // $dados = $usuarioSelecionado;

    $c = new conexao();
    $query = "SELECT * , DATE_FORMAT(Data_Refeicao,'%d/%m/%Y') AS DataFormatada FROM tb_rotina Rotina LEFT JOIN tb_Usuario usuario ON usuario.Id_Usuario = rotina.Id_Usuario LEFT JOIN tb_Alimento alimento ON alimento.Id_Alimento = rotina.Id_Alimento LEFT JOIN tb_profissional prof ON rotina.Id_Profissional = prof.Id_Profissional WHERE rotina.Id_Rotina = '$userSelect';";

    $stms = $c->conectar()->prepare($query);
    $stms->execute();

    $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultado as $linha){
        $info1 = "Data Refeição: ".$linha['DataFormatada']."<br>";
        $info2 = "Qtde Calorias consumidas: ".$linha['Calorias']." Kcal <br>";
        $info3 = "Qtde Carboidratos consumidos: ".$linha['Carboidratos'] . " g <br>";
        $info4 = "Qtde Proteínas consumidas: ".$linha['Proteinas'] . " g <br>";
        $info5 = "Qtde Gorduras consumidas: ".$linha['Gorduras'] . " g <br>";
    }


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
    $dados .= $info1;
    $dados .= $info2;
    $dados .= $info3;
    $dados .= $info4;
    $dados .= $info5;
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