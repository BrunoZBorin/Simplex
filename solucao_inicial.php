<?php
    session_start();
    
    $vlr_ini_restricoes = $_SESSION['valor_inicial'];
    $numero_restricoes = $_SESSION['quant_var_restricao'];
    $numero_decisoes = $_SESSION['quant_var_decisao'];
    $numero_de_linhas = $_SESSION['numero_de_linhas'];
    $numero_de_colunas = $_SESSION['numero_de_colunas'];
    $solucao_final = $_SESSION['final'];
    $coluna_variaveis = $_SESSION['coluna_variaveis'];
    $coluna_variaveis[$numero_restricoes]= 'Lucro';
    if(array_key_exists('button1', $_POST)) { 
        button1();
    }
    function button1() {
        if($_SESSION['intera']<=$_SESSION['index_final']){
            $_SESSION['intera']++;
        }else{
            header('Location: tabela.php');
        } 
    }
    $solucao_parcial = $_SESSION['solucao_parcial'][$_SESSION['intera']];
?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Simplex</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>

  <body class="mx-5">
  <h3>Solução parcial</h3>
  <h4>Interação: <?php echo $_SESSION['intera']+1; ?> </h4>
  <div class="row">
      <table class="table table-bordered table-striped table-highlight">
        <thead>
          <tr>
                    <th></th>
                <?php for($y =1;$y<=$numero_decisoes; $y++): ?>
                    <th>X<?= $y ?></th>
                <?php endfor; ?>
                <?php for($y =1;$y<=$numero_restricoes; $y++): ?>
                    <th>F<?= $y ?></th>
                <?php endfor; ?>
                    <th>B</th>
          </tr>
        </thead>
        <tbody>
        <?php for($x =0, $f=1;$x<=$numero_de_linhas; $x++, $f++){ 
            echo "<tr>";
            if($x==$numero_de_linhas){
                echo"<td>Z</td>";    
            }else{
                echo"<td>".$coluna_variaveis[$x]."</td>";
            }
            for($y =0;$y<=$numero_de_colunas; $y++){    
              echo"<td>".$solucao_parcial[$x][$y]."</td>";
            }
            echo"</tr>";
        }?>
                  
        </tbody>
      </table>
  </div>
  <div class="row">
       
        <a href="tabela.php" >
        <button class="btn btn-primary btn-lg" type="submit">
            Solucao Final
        </button>
        </a>
        <div></div>
        <form method="post">
            <input type="submit" name="button1"
            class="btn btn-secondary btn-lg" value="Mais uma interação" /> 
        </form>
    </div>
        </a>


        </body>
</html>