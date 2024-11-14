<?php
class conexao{
    function conectar(){
        return $conn = new PDO("mysql:dbname=db_nutriplanner;host=localhost","root","");
    }
    function executar($query,$array){
        //$query seria o comando MySQL
        // $array seria o conjunto de dados que irão vincular ao comando
        // $stms = statement
        // Seria a parte da operação a ser realizada

        $stms = $this->conectar()->prepare($query);
        // prepara a query SQL a ser executada

        $stms->execute($array);
        // executa a Query com base no array de dados informados
    }
    function listar($query){
        $stms = $this->conectar()->prepare($query);
        $stms->execute();
  
        $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);
        // Pega os dados da consulta e joga dentro de um array
        return $resultado;
    }
}
$usuario = "root";
$senha = "";
$host = "localhost";
$database = "db_nutriplanner";

$mysqli = new mysqli($host, $usuario, $senha, $database);


if($mysqli -> error){
    die("Falha na execução da conexão". $mysqli->error);
}

