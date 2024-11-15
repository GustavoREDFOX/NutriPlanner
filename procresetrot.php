<?php
include('conexao.php');
include('protect.php');

$id = $_SESSION['id'];

$sql_code = "UPDATE tb_rotina
            SET Calorias = 0, 
            Carboidratos = 0,
            Proteinas = 0,
            Gorduras = 0
            WHERE Data_Refeicao = CURRENT_DATE and Id_Usuario = '$id'";
$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
header('Location: telarotinapaciente.php');