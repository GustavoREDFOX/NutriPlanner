<?php
include('protect.php');
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>NutriPlanner</title>
  <!-- Link CSS do arquivo -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Link CSS do bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    footer {
      margin-top: 20px;
      display: flex;
      justify-content: center;
    }

    .container-footer {
      background-color: #3f3f3f;
      color: #F6F3F3;
    }
  </style>
</head>

<body>
  <header class="" style="display: inline;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: static; width: 100%;">
      <img src="img/Nova Logo NutriPlanner.png" alt="" width="10%" class=""
        style="margin-top: 12px; margin-left: 12px; position: static;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown"
        style="display: flex; justify-content: center; margin-left: -180px;">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Dashboard<span class="sr-only">(Página atual)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="telarotinapaciente.php">Rotina</a>
          </li>
          <li class="nav-item">
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>
    <!-- Essa sessão mostra as informações de metas e porcentagem atingida -->
    <section>
      <?php
      include('conexao.php');
      $c = new conexao();

      $idUsuarioLogado = $_SESSION['id'];

      $query = "SELECT * FROM tb_rotina WHERE Data_Refeicao = CURRENT_DATE and Id_Usuario = '$idUsuarioLogado';";

      $stms = $c->conectar()->prepare($query);
      $stms->execute();

      $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);


      foreach ($resultado as $row) {
        echo "<br>";
        echo $row['Data_Refeicao'];
        if ($row['Calorias'] == 0) {
          $porceMetCalo = 0;
          echo "<p>Percentual Caloria: $porceMetCalo % Concluído";
        } else {
          $porceMetCalo = ($row['Calorias'] / $row['Calorias_Meta']) * 100;
          echo "<p>Percentual Calorias: $porceMetCalo % Concluído";
        }
        if ($row['Carboidratos'] == 0 || $row['Carboidratos'] == "") {
          $porceMetCarbo = 0;
          echo "<p>Percentual Carboidratos: $porceMetCarbo % Concluído</p>";
        } else {
          $porceMetCarbo = ($row['Carboidratos'] / $row['Carboidratos_Meta']) * 100;
          echo "<p>Percentual Carboidratos: $porceMetCarbo % Concluído</p>";
        }
        if ($row['Proteinas'] == 0 || $row['Proteinas'] == "") {
          $porceMetProt = 0;
          echo "<p>Percentual Proteínas: $porceMetProt % Concluído</p>";
        } else {
          $porceMetProt = ($row['Proteinas'] / $row['Proteinas_Meta']) * 100;
          echo "<p>Percentual Proteínas: $porceMetProt % Concluído</p>";
        }
        if ($row['Gorduras'] == 0 || $row['Gorduras'] == "") {
          $porceMetGordu = 0;
          echo "Percentual Gordura: $porceMetGordu % Concluído";
        } else {
          $porceMetGordu = ($row['Gorduras'] / $row['Gordura_Meta']) * 100;
          echo "Percentual Gordura: $porceMetGordu % Concluído";
        }
        
      }
      ?>
    </section>
    <!-- Essa sessão mostra a quantidade de refeições dia -->
    <section></section>
    <!-- Esse campo mostra o IMC -->
    <section>
      <div>
        <?php

        ?>
      </div>
    </section>
  </main>
  <div class="container-footer" style="position:absolute; bottom: 0; width:100%;">
        <hr style="width: 80%; margin-top: 90px;">
        <footer>
            <div>
                <p>Tatuí - SP - Brasil</p>
                <p><b>CEP 18270-000</b></p>
                <br>
                <br>
                <hr>
                <p>© Todos os Direitos reservados 2024 | Elaborado para fins acadêmicos</p>
                <br>
            </div>
        </footer>
    </div>
</body>
<!-- Javascript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>