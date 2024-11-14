<?php
include('conexao.php');

$nomeUsuario = $_POST['nomeUsuario'];
$email = $_POST['email'];
$senhaUsuario = $_POST['senha'];
$cpf = $_POST['cpf'];
$logradouro = $_POST['logradouro'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$cep = $_POST['cep'];
$uf = $_POST['uf'];
$telefone = $_POST['telefone'];
$dataNascimento = $_POST['dataNascimento'];
$peso = $_POST['peso'];
$altura = $_POST['altura'];
$observacoes = $_POST['observacoes'];
$profissional = $_POST['profissional'];

if ($profissional == "P") {
    $sql_code = "INSERT INTO tb_profissional VALUES(0, '$nomeUsuario', '$email', '$senhaUsuario','$logradouro','$bairro','$cidade','$cep','$uf','$cpf','$dataNascimento','','$telefone','','','')";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
    header('Location: loginnutricionista.php');
} else{
    $sql_code = "INSERT INTO tb_usuario VALUES(0, '$nomeUsuario', '$email', '$senhaUsuario','$logradouro','$bairro','$cidade','$cep','$uf','$telefone','$dataNascimento','$cpf','$peso','$altura','$observacoes')";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
    header('Location: login.php');}

