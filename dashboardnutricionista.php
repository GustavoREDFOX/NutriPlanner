<?php
// include('protect.php');
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
    .container-usuario-link{
      display: flex;
    }
    #link-paciente-relat{
      text-decoration: none;
      color: #3f3f3f;
      margin: 5px;
    }
    #link-paciente-relat:hover{
      color: forestgreen;
      scale: 1.03;
      transition-duration: 0.1s;
    }
    #btn_Consulta{
      width: 900px;
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
            <a class="nav-link" href="telatarefasnutricionista.php">Tarefas</a>
          </li>
          <li class="nav-item">
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>
    <h4 style="text-align: center; margin:15px">Lista de Pacientes</h4>
    <div class="" style="display: flex; justify-content:center">
    <div class="" style="display:flex; flex-direction:column; ">
      <?php
      include_once('conexao.php');
      $c = new conexao();
      $query = "SELECT * FROM tb_Usuario usuario RIGHT JOIN Tb_Rotina rotina ON usuario.Id_Usuario = rotina.Id_Usuario LEFT JOIN tb_Alimento alimento ON alimento.Id_Alimento = rotina.Id_Alimento GROUP BY Usuario_Nome";

      $stms = $c->conectar()->prepare($query);
      $stms->execute();

      $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);
      foreach ($resultado as $row) {
        echo "<form action='procpdf.php' method='POST'>";
        echo "<div class='container-usuario-link'>";
        echo "<a href='procpdf.php?id=".$row['Usuario_Nome']."' id='link-paciente-relat'><button type='submit' class='btn btn-light' id='btn_Consulta' name='id' value=".$row['Id_Usuario'].">Paciente: " . $row['Usuario_Nome'] . " | Data primeira rotina" .$row['Data_Refeicao'] ."</button></a>";
        echo "</div>";
        echo "</form>";
      }

      $pdo = null;
      ?>

    </div>
    </div>
  </main>
  <div class="container-footer" style="position:absolute; bottom: 0; width:100% ">
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