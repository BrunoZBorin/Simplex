<?php
    session_start();
    $vlr_ini_restricoes = $_SESSION['valor_inicial'];
    $numero_restricoes = $_SESSION['quant_var_restricao'];
    $numero_decisoes = $_SESSION['quant_var_decisao'];
    $numero_de_linhas = $_SESSION['numero_de_linhas'];
    $numero_de_colunas = $_SESSION['numero_de_colunas'];
    $variaveis = [];
    for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      $variaveis[$i] = 'X'.$j;
    }
    for($i=$numero_decisoes+1, $x = 1; $x<=$numero_restricoes; $i++, $x++){
      $variaveis[$i] = 'F'.$x;
    }
    $vlr_inicial = [];
    for($i=0; $i<$numero_decisoes; $i++){
      $vlr_inicial[$i] = 0;
    }
    for($i=$numero_decisoes, $x = 0; $i<$numero_restricoes; $i++, $x++){
      $vlr_inicial[$i] = $vlr_ini_restricoes[$x];
    }

    echo "Decisao".$numero_decisoes.'<br>';
    echo "Restricao".$numero_restricoes.'<br>';
    foreach($_SESSION['final'] as $key=>$e){
      print_r($e);
      echo '<br>';
    }
    
?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Simplex</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-abrir-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>
  <div class="table-responsive">
        <table class="table">
        
        <thead>
            <tr>
            <th scope="col">Variável</th>
            <th scope="col">Tipo</th>
            <th scope="col">Vlr Inicial</th>
            <th scope="col">Vlr Final</th>
            <th scope="col">Var Básica</th>
            <th scope="col">Escasso</th>
            <th scope="col">Sobra recurso</th>
            <th scope="col">Uso recurso</th>
            <th scope="col">Preço sombra</th>
            <th scope="col">Custo reduzido</th>
            <th scope="col">Vlr Final</th>
            <th scope="col">Aum. Parametro</th>
            <th scope="col">Red. Parâmetro</th>
            <th scope="col">Máximo</th>
            <th scope="col">Mínimo</th>
            </tr>
        </thead>
        <tbody>
        <?php for($x=0;$x<=$numero_de_colunas; $x++){ 
            echo "<tr>";?>
            <th scope="col"><?php echo $variaveis[$x]?></th>
            <th scope="col">Tipo</th>
            <th scope="col"><?php echo  $vlr_inicial[$x]?></th>
            <th scope="col">Vlr Final</th>
            <th scope="col">Var Básica</th>
            <th scope="col">Escasso</th>
            <th scope="col">Sobra recurso</th>
            <th scope="col">Uso recurso</th>
            <th scope="col">Preço sombra</th>
            <th scope="col">Custo reduzido</th>
            <th scope="col">Vlr Final</th>
            <th scope="col">Aum. Parametro</th>
            <th scope="col">Red. Parâmetro</th>
            <th scope="col">Máximo</th>
            <th scope="col">Mínimo</th>           
          <?php
            echo"</tr>";
        }?>
        </tbody>
        </table>
    </div>
        </body>
</html>