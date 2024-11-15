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

    #itens-dashboard div:hover {
      scale: 1.05;
      transition: 0.2s;
    }
  </style>
</head>

<body>
  <header class="" style="display: inline;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: static; width: 100%;">
      
      <div class="d-flex justify-content-between">
      <div>
        <img src="img/Nova Logo NutriPlanner.png" alt="" width="10%" class=""
          style="margin-top: 12px; margin-left: 12px; position: static;">
      </div>
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
      <div style=" display:flex ; height: 70px;align-items: center; margin-top:10px;">
        <a href="logout.php"><img src="img/iconUser.png" alt="" class="rounded-circle" width="70px"></a>
      </div>
      </div>
    </nav>
  </header>
  <main style="margin: 0;">
    <!-- Essa sessão mostra as informações de metas e porcentagem atingida -->
    <section>
      <?php
      include('conexao.php');
      $c = new conexao();

      $idUsuarioLogado = $_SESSION['id'];

      $query = "SELECT * , DATE_FORMAT(Data_Refeicao, '%d/%m/%Y') AS DataFormatada FROM tb_rotina WHERE Data_Refeicao = CURRENT_DATE and Id_Usuario = '$idUsuarioLogado';";

      $stms = $c->conectar()->prepare($query);
      $stms->execute();

      $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);

      $porceMetCalo = 0;
      $porceMetCarbo = 0;
      $porceMetProt = 0;
      $porceMetGordu = 0;

      foreach ($resultado as $row) {
        echo "<br>";

      ?>
        <div class="alert alert-secondary d-flex justify-content-center" role="alert" style="width: 30%; margin-left: 5px ; ">
          <?php echo "<b>Data da Refeição: " . $row['DataFormatada'] . "</b>"; ?>
        </div>
      <?php

        if ($row['Calorias'] == 0) {
          $porceMetCalo = 0;
        } else {
          $porceMetCalo = ($row['Calorias'] / $row['Calorias_Meta']) * 100;
        }
        if ($row['Carboidratos'] == 0 || $row['Carboidratos'] == "") {
          $porceMetCarbo = 0;
        } else {
          $porceMetCarbo = ($row['Carboidratos'] / $row['Carboidratos_Meta']) * 100;
        }
        if ($row['Proteinas'] == 0 || $row['Proteinas'] == "") {
          $porceMetProt = 0;
        } else {
          $porceMetProt = ($row['Proteinas'] / $row['Proteinas_Meta']) * 100;
        }
        if ($row['Gorduras'] == 0 || $row['Gorduras'] == "") {
          $porceMetGordu = 0;
        } else {
          $porceMetGordu = ($row['Gorduras'] / $row['Gordura_Meta']) * 100;
        }
      }

      $query = "SELECT * FROM tb_usuario WHERE Id_Usuario = '$idUsuarioLogado';";

      $stms = $c->conectar()->prepare($query);
      $stms->execute();

      $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);

      foreach ($resultado as $row) {
        $PesoInicial = $row['Peso_Inicial'];
        $AlturaInicial = $row['Altura_Inicial'];
      }
      $ResultadoIMC = $PesoInicial / ($AlturaInicial * $AlturaInicial);

      if ($ResultadoIMC >= 40) {
        $ResultadoTxt = "Obesidade Grau III";
      } elseif ($ResultadoIMC < 40 && $ResultadoIMC >= 35) {
        $ResultadoTxt = "Obesidade Grau II";
      } elseif ($ResultadoIMC < 35 && $ResultadoIMC >= 30) {
        $ResultadoTxt = "Obesidade Grau I";
      } elseif ($ResultadoIMC < 30 && $ResultadoIMC >= 25) {
        $ResultadoTxt = "Pré-obesidade";
      } elseif ($ResultadoIMC < 25 && $ResultadoIMC >= 18.5) {
        $ResultadoTxt = "Peso Normal";
      } elseif ($ResultadoIMC < 18.5) {
        $ResultadoTxt = "Abaixo do peso";
      } else [
        $ResultadoTxt = "Peso Inválido, Verifique seu cadastro"
      ]
      ?>
      <div class="d-flex justify-content-around">


        <div class="" id="itens-dashboard">
          <div class="card border-dark mb-3" style="width: 20rem;">
            <div class="card-body">
              <h5 class="card-title">Calorias Consumidas</h5>
              <h6 class="card-subtitle mb-2 text-muted">Percentual de Meta</h6>
              <p style="font-size: 25px;"><?php echo "$porceMetCalo" . "% <b>Concluído</b>"; ?></p>
            </div>
          </div>
          <div class="card border-dark mb-3" style="width: 20rem;">
            <div class="card-body">
              <h5 class="card-title">Carboidratos Consumidas</h5>
              <h6 class="card-subtitle mb-2 text-muted">Percentual de Meta</h6>
              <p style="font-size: 25px;"><?php echo "$porceMetCarbo" . "% <b>Concluído</b>"; ?></p>
            </div>
          </div>
          <div class="card border-dark mb-3" style="width: 20rem;">
            <div class="card-body">
              <h5 class="card-title">Proteínas Consumidas</h5>
              <h6 class="card-subtitle mb-2 text-muted">Percentual de Meta</h6>
              <p style="font-size: 25px;"><?php echo "$porceMetProt" . "% <b>Concluído</b>"; ?></p>
            </div>
          </div>
          <div class="card border-dark mb-3" style="width: 20rem;">
            <div class="card-body">
              <h5 class="card-title">Gorduras Consumidas</h5>
              <h6 class="card-subtitle mb-2 text-muted">Percentual de Meta</h6>
              <p style="font-size: 25px;"><?php echo "$porceMetGordu" . "% <b>Concluído</b>"; ?></p>
            </div>
          </div>
        </div>
        <div>
          <div class="card border-info mb-3" style="width: 25rem;">
            <div class="card-body">
              <h5 class="card-title">IMC(Índice de Massa Corporal)</h5>
              <h6 class="card-subtitle mb-2 text-muted">Percentual de Meta</h6>
              <p style="font-size: 25px;"><?php echo "Cálculo: " . number_format($ResultadoIMC, 2, ',', '.'); ?></p>
              <p style="font-size: 25px;"><?php echo "Resultado: " . "<b>$ResultadoTxt</b>"; ?></p>
            </div>
          </div>
          <div class="card border-info mb-3" style="width: 25rem;">
            <div class="card-body">
              <h5 class="card-title">Informações do Paciente</h5>
              <h6 class="card-subtitle mb-2 text-muted">Dados Cadastrais</h6>
              <p style="font-size: 25px;"><?php echo "Peso Atual: " . $PesoInicial . " Kg"; ?></p>
              <p style="font-size: 25px;"><?php echo "Altura Atual: " . $AlturaInicial . " cm"; ?></p>
            </div>
          </div>
        </div>
      </div>
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
  <hr width="80%">
  <div class="container-footer">
    <hr style="width: 80%; margin-top: 30px;">
    <footer>
      <div>
        <p>Tatuí - SP - Brasil</p>
        <p><b>CEP 18270-000</b></p>
        <br>
        <div class="d-flex justify-content-between">
          <div>
            <a href="#"><img src="img/github.png" alt="" width="25px"></a>
            <a href="#"><img src="img/instagram.png" alt="" width="25px"></a>
            <a href="#"><img src="img/whatsapp.png" alt="" width="25px"></a>
          </div>
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" style=""><img src="img/linkedin.png" alt="" width="20px" style="vertical-align:sub;">
              LinkedIn
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <a class="dropdown-item" href="https://www.linkedin.com/in/felipe-oliveira-468a4226a/">Felipe Gustavo</a>
              <a class="dropdown-item" href="#">Gabriel Cipriani</a>
              <a class="dropdown-item" href="https://www.linkedin.com/in/gustavodealmeida1/">Gustavo Almeida</a>
            </div>
          </div>
        </div>
        <br>
        <hr>
        <p>© 2024 Todos os Direitos reservados. Elaborado para fins acadêmicos</p>
        <div class="d-flex justify-content-around" style="margin-bottom: 25px;">
          <a href="extra-content/DOC NutriPlanner Privacidade.pdf" style="color:#91bd97">Politica e Privacidade</a>
          <a href="https://www.gov.br/esporte/pt-br/acesso-a-informacao/lgpd" style="color:#91bd97">LGPD</a>
        </div>
      </div>
    </footer>
  </div>
</body>
<!-- Javascript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>