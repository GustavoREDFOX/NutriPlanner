<?php
// include('protect.php');
require('conexao.php');
?>
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
    main {
      display: block
    }

    .form_rotina {
      width: 48%;
      margin-top: 20px;
      margin-left: 50px;
      margin-right: 50px;
    }

    @media (max-width: 768px) {
      .form_rotina {
        width: 100%;
        margin: 10px;
      }
    }

    form button {
      border-radius: 8px;
      width: 200px;
    }

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
          <li class="nav-item">
            <a class="nav-link" href="dashboardnutricionista.php">Dashboard</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Tarefas<span class="sr-only">(Página atual)</span></a>
          </li>
          <li class="nav-item">
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>
    <div class="form_rotina">
      <form action="procref.php" method="POST">
        <div class="form-group">
          <label for="exampleFormControlSelect1">Selecionar Paciente</label>
          <select class="form-control" id="exampleFormControlSelect1" name="usuario-selecionado">
            <?php

            $sql_code = "SELECT Id_Usuario ,Usuario_Nome FROM Tb_Usuario";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

            $result = $sql_query;

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["Id_Usuario"] . "'> ID " . $row["Id_Usuario"] . " | " . $row["Usuario_Nome"] . "</option>";
              }
            } else {
              echo '<option>Nenhum paciente encontrado</option>';
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Quantidade de Calorias para consumir</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Calorias" name="calorias" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Quantidade de Carboidratos para consumir</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Carboidratos" name="carboidratos" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Quantidade de Proteinas para consumir</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Proteinas" name="Proteinas" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Quantidade de Gorduras para consumir</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Gorduras" name="Gorduras" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Refeição do dia</label>
          <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="DiaDaSemana" name="DataRefeicao" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Observações</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="Observacoes"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Refeição</button>
        <button type="reset" class="btn btn-secondary">Limpar</button>
      </form>
    </div>
  </main>
  <div class="container-footer">
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