<?php 

session_start();
    $teste = $_SESSION['valores'];
    
    $interacoes = $_POST['interacoes'];
    $_SESSION['interacoes'] = $interacoes;

$qtd_var_decisao = $_POST['quant_var_decisao'];
$qtd_var_restricao = $_POST['quant_var_restricao'];
$_SESSION['quant_var_restricao']= $_POST['quant_var_restricao'];
$_SESSION['quant_var_decisao'] = $_POST['quant_var_decisao'];
$colunas = $_POST['quant_var_decisao']+$_POST['quant_var_restricao'];
$linhas = $_POST['quant_var_restricao'];
echo 'Interacoes :'.$interacoes.'<br>';
echo 'colunas :'.$colunas.'<br>';
echo 'linhas :'.$linhas.'<br>';
?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Simplex</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

  </head>

    <body class="solucao">
    <form class="form-horizontal" action="calcula_valores.php" method="post">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-highlight">
            <thead>
                <tr>
                    <th></th>
                <?php for($y =1;$y<=$qtd_var_decisao; $y++): ?>
                    <th>X<?= $y ?></th>
                <?php endfor; ?>
                <?php for($y =1;$y<=$qtd_var_restricao; $y++): ?>
                    <th>F<?= $y ?></th>
                <?php endfor; ?>
                    <th>B</th>
                </tr>
            </thead>
            <tbody>
            <?php for($x =0, $f=1;$x<=$linhas; $x++, $f++){ 
            echo "<tr>";
            if($x==$linhas){
                echo"<td>Lucro</td>";    
            }else{
                echo"<td>F".$f."</td>";
            }
            for($y =0;$y<=$colunas; $y++){    
                echo"<td><input type='number' step='.0001'class='form-control' name='basico[".$x."][".$y."]'/></td>";
                }
            echo"</tr>";
        }?>
            </tbody>
        </table> 
    </div>
    <div class="4ol-6">
        <button class="btn btn-lg btn-info btn-block" type="submit">Calcular</button>
    </div>
    <form>
  </body>
</html>
