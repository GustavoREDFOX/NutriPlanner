<?php
    include('conexao.php');

    $calorias = $_POST["calorias"];
    $dataRefeicao = $_POST['DataRefeicao'];
    $observacoes = $_POST['Observacoes'];
    $Id_Usuario = $_POST['usuario-selecionado'];
    $carboidratos = $_POST['carboidratos'];
    $proteinas = $_POST['Proteinas'];
    $gorduras = $_POST['Gorduras'];

    $sql_code = "INSERT INTO Tb_Rotina VALUES (0, '$Id_Usuario','9999','$dataRefeicao','P',
    '$observacoes','$calorias','$carboidratos', '$proteinas', '$gorduras', '0','0','0','0','4')";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: ". $mysqli->error);

    header('Location: telatarefasnutricionista.php');