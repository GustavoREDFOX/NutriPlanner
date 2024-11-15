<?php
include('conexao.php');
include('protect.php');

$c = new conexao();
$Alimento = $_POST['state'];
$Quantidade = $_POST['qtdeConsumida'];

if($Alimento == "AL"){
    header('Location: telarotinapaciente.php');
}

$query = "SELECT Id_Alimento, Nome_Alimento, Kcal, Carboidratos, Proteina, Gordura FROM tb_alimento WHERE Id_Alimento = $Alimento";

$id = $_SESSION['id'];

$stms = $c->conectar()->prepare($query);
$stms->execute();

$resultado = $stms->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $row) {
    $Caloria = ($row["Kcal"]);
    $CaloriaFormatada = ($Caloria / 100) * $Quantidade;
    $Carboidratos = ($row['Carboidratos']);
    $CarboidratosFormatada = ($Carboidratos / 100) * $Quantidade;
    $Proteinas = ($row["Proteina"]);
    $ProteinasFormatada = ($Proteinas / 100) * $Quantidade;
    $Gordura = ($row['Gordura']);
    $GorduraFormatada = ($Gordura / 100) * $Quantidade;

    $sql_code = "UPDATE tb_rotina
    SET Calorias = COALESCE(Calorias,0) + $CaloriaFormatada, 
    Carboidratos = COALESCE(Carboidratos,0) + $CarboidratosFormatada,
    Proteinas = COALESCE(Proteinas,0) + $ProteinasFormatada,
    Gorduras = COALESCE(Gorduras,0) + $GorduraFormatada
    WHERE Data_Refeicao = CURRENT_DATE and Id_Usuario = '$id'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
}
header('Location: telarotinapaciente.php');



