<?php
include('protect.php');
include('conexao.php');
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .container-tabela-rotina table {
      display: flex;
      justify-content: center;
      border: solid, gray;
    }

    main .section-table {
      display: flex;
      justify-content: center;
      margin-bottom: 25px;
    }

    div section {
      display: inline;
      width: 1000px;
    }

    select {
      overflow-wrap: break-word;
    }

    th {
      margin: 25px;
    }

    footer {
      margin-top: 25px;
    }

    .container-center-blocks-form {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 150%;
    }

    @media (max-width:768px) {
      .container-center-blocks-form {
        display: flex;
        flex-direction: column;
        align-items: start;
        width: 100%;
        margin-left: 15px
      }
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

      <div class="d-flex justify-content-between">
        <div>
          <img src="img/Nova Logo NutriPlanner.png" alt="" width="10%" class=""
            style="margin-top: 12px; margin-left: 12px; position: static;">
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDropdown"
          style="display: flex; justify-content: center; margin-left: -180px;">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Rotina<span class="sr-only">(Página atual)</span></a>
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
  <main>
    <section class="section-table">
      <div class="container-tabela-rotina">

        <!-- <table class="table" style="font-size: 15px;">
          <tr>
            <th>Data Refeição</th>
            <th>Calorias</th>
            <th>Carboidratos</th>
            <th>Proteínas</th>
            <th>Gorduras</th>
            <th>Result. Calorias</th>
            <th>Result. Carboidratos</th>
            <th>Result. Proteinas</th>
            <th>Result. Gorduras</th>

          </tr> -->
        <?php

        $idUsuarioLogado = $_SESSION['id'];

        $MetCalo = 0;
        $MetCarbo = 0;
        $MetProt = 0;
        $MetGordu = 0;

        $CaloCons = 0;
        $CarboCons = 0;
        $ProtCons = 0;
        $GorduCons = 0;

        $c = new conexao();
        $query = "SELECT Id_Rotina, Data_Refeicao, Status_Refeicao, Observacao, Calorias_Meta, Carboidratos_Meta, Proteinas_Meta, Gordura_Meta, rotina.Calorias, rotina.Carboidratos, rotina.Proteinas, rotina.Gorduras, usuario.Usuario_Nome FROM tb_usuario usuario RIGHT JOIN tb_rotina rotina ON usuario.Id_Usuario = rotina.Id_Usuario LEFT JOIN tb_alimento alimento ON alimento.Id_Alimento = rotina.Id_Rotina WHERE rotina.Data_Refeicao = CURRENT_DATE and usuario.Id_Usuario = '$idUsuarioLogado' GROUP BY usuario.Usuario_Nome";

        $stms = $c->conectar()->prepare($query);
        $stms->execute();

        $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {

          $DataRef = $row["Data_Refeicao"];
          $MetCalo = $row["Calorias_Meta"];
          $MetCarbo = $row["Carboidratos_Meta"];
          $MetProt = $row["Proteinas_Meta"];
          $MetGordu = $row["Gordura_Meta"];

          $CaloCons = $row["Calorias"];
          $CarboCons = $row["Carboidratos"];
          $ProtCons = $row["Proteinas"];
          $GorduCons = $row["Gorduras"];
        }
        ?>

        <!-- </table> -->
        <div class="alert alert-dark" role="alert">
          <h4 class="d-flex justify-content-center">Inserir Rotina Alimentar</h4>
        </div>
        <div class="">
          <div class="list-group">
            <div class="d-flex justify-content-between">
              <button type="button" class="list-group-item list-group-item-action ">Meta Calorias <?php echo "<b>" . $MetCalo . " Kcal</b>"; ?></button>
              <button type="button" class="list-group-item list-group-item-action">Meta Carboidratos <?php echo "<b>" . $MetCalo . " Kcal</b>"; ?></button>
              <button type="button" class="list-group-item list-group-item-action">Meta Proteínas <?php echo "<b>" . $MetCalo . " Kcal</b>"; ?></button>
              <button type="button" class="list-group-item list-group-item-action">Meta Gordura <?php echo "<b>" . $MetCalo . " Kcal</b>"; ?></button>
            </div>
            <div>
              <button type="button" class="list-group-item list-group-item-action d-flex justify-content-between">Calorias Consumidas <p><?php echo $CaloCons . " Kcal"; ?></p></button>
              <button type="button" class="list-group-item list-group-item-action d-flex justify-content-between">Carboidratos Consumidos <p><?php echo $CarboCons . " g"; ?></p></button>
              <button type="button" class="list-group-item list-group-item-action d-flex justify-content-between">Proteínas Consumidas <p><?php echo $ProtCons . " g"; ?></p></button>
              <button type="button" class="list-group-item list-group-item-action d-flex justify-content-between">Gordura Consumida <p><?php echo $GorduCons . " g"; ?></p></button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="d-flex justify-content-center">
      <div class="container-inserir-dados">
        <section id="section-form" class="">
          <div class="">
            <form action="procrot.php" method="post" class="inserir-refeicao-form">
              <label>Selecione um alimento</label>
              <br>
              <select class="js-example-basic-single" name="state" style="width:400px'">
                <option value="AL">Selecione um opção de alimento</option>
                <?php

                $sql_code = "SELECT Id_Alimento, Nome_Alimento, Kcal, Carboidratos, Proteina, Gordura FROM tb_alimento";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

                $result = $sql_query;
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["Id_Alimento"] . "'> ID " . $row["Id_Alimento"] . " | " . $row["Nome_Alimento"] . "</option>";
                  }
                } else {
                  echo '<option>Nenhum alimento</option>';
                }
                ?>
              </select>
              <br>
              <br>
              <div class="">
                <label>Quantidade Consumida</label>
                <input type="text" name="qtdeConsumida" id="" placeholder="Digite a quantidade de gramas consumidas" width="100px" required>
              </div>
              <br>
              <br>
              <br>
              <button type="submit" class="btn btn-primary">Atualizar Rotina</button>
              <button type="reset" class="btn btn-secondary">Limpar Campos</button>
              <button type="button" class="btn btn-warning" name="" data-toggle="modal" data-target="#modalExemplo">Resetar Rotina</button>
            </form>
            <!-- Modal de confirmação reset -->
            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação para zerar rotina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Você tem certeza que deseja resetar sua rotina?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="procresetrot.php" method="POST">
                      <button type="submit" class="btn btn-primary">Sim</button>
                    </form>

                  </div>
                </div>
              </div>
            </div>

            <br>
            <h4>Consulta a Tabela TBCA</h4>
            <div class="d-flex justify-content-center" width="100%" style="margin-top: 40px">
              <iframe src="consulta.php" frameborder="0" width="900px" height="300px" class="">
              </iframe>
            </div>
          </div>
        </section>
      </div>
    </div>

  </main>
  <div class="container-footer">
    <hr style="width: 80%; margin-top: 90px;">
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });
</script>

</html>