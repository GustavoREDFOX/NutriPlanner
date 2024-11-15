<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <table class="table" id="Tab">
        <div class="form-inline" style="margin: px; position:fixed; background-color:#fff; padding: 3px; width:100%">
            <input type="text" id="Busca" class="form-control mr-sm-2" placeholder="Pesquisar">
            <button id="btnBuscar" class="btn btn-outline-success my-2 my-sm-0" ><b>Buscar</b></button>
            <br>
        </div>
        <br>
        <br>
        <br>
        <p style="margin: 5px;"><b>Valores em 100g</b></p>
        
        <tr>
            <th>Alimento</th>
            <th>Calorias</th>
            <th>Carboidratos</th>
            <th>Proteinas</th>
            <th>Gordura</th>
        </tr>
        <?php
        include('conexao.php');
        $c = new conexao();
        $query = "SELECT Id_Alimento, Nome_Alimento, Kcal, Carboidratos, Proteina, Gordura FROM tb_alimento;";

        $stms = $c->conectar()->prepare($query);
        $stms->execute();

        $resultado = $stms->fetchAll(PDO::FETCH_ASSOC);


        foreach ($resultado as $row) {
            echo "<tr>";
            echo "<td>" . $row["Nome_Alimento"] . "</td>";
            echo "<td>" . $row["Kcal"] . "Kcal</td>";
            echo "<td>" . $row["Carboidratos"] . "g</td>";
            echo "<td>" . $row["Proteina"] . "g</td>";
            echo "<td>" . $row["Gordura"] . "g</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
<script>
    document.getElementById("btnBuscar").addEventListener("click", Pesquisar);

    function Pesquisar() {
        // Variáveis da função
        var Coluna = "0";
        var Filtrar, Tabela, tr, td, th, i;

        Filtrar = document.getElementById("Busca");
        Filtrar = Filtrar.value.toUpperCase();

        Tabela = document.getElementById("Tab");
        tr = Tabela.getElementsByTagName("tr");
        th = Tabela.getElementsByTagName("th");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[Coluna];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(Filtrar) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

</html>