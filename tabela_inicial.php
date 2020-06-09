<?php 

session_start();
    $teste = $_SESSION['valores'];
    $_SESSION['problema']=$_POST['problema'];
    $interacoes = $_POST['interacoes'];
    $_SESSION['interacoes'] = $interacoes;

$qtd_var_decisao = $_POST['quant_var_decisao'];
$qtd_var_restricao = $_POST['quant_var_restricao'];
$_SESSION['quant_var_restricao']= $_POST['quant_var_restricao'];
$_SESSION['quant_var_decisao'] = $_POST['quant_var_decisao'];
$colunas = $_POST['quant_var_decisao']+$_POST['quant_var_restricao'];
$linhas = $_POST['quant_var_restricao'];
$problema = '';
if($_SESSION['problema']=='Maximizar'){
    $problema = '>=';
}else{
    $problema = '<=';
}

?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Simplex</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

  </head>
    <body class="mx-5">
    <h2>Função inicial</h2>

    <form class="form-horizontal" action="calcula_valores.php" method="post">
    <table class="table table-bordered">
        <thead>
            <tr>
                <?php for($y =1;$y<=$qtd_var_decisao; $y++): ?>
                    <th>Variável de decisão</th>
                    <th>Descrição da variável de decisão</th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
            
            <?php for($y =0, $x=1;$y<$qtd_var_decisao; $y++, $x++){
              echo  "<td >X".$x."</td>";
              echo  "<td><input type='text' class='form-control w-50 p-3' name='descricao_X[".$y."]'/></td>";
            } ?>
            
            </tr>
        </tbody>
    </table>
    <div class="table-responsive">
        <h3>Insira os dados da solução inicial</h3>
        <h5>Frações de número inteiro devem ser divididas por ponto com no máximo 4 casas após o ponto </h5>
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
                    <th></th>
                    <th>B</th>
                    <th>Descrição da variável de folga</th>
                </tr>
            </thead>
            <tbody>
            <?php for($x=0, $f=1;$x<=$linhas; $x++, $f++){ 
            echo "<tr>";
            if($x==$linhas&&$_SESSION['problema']=='Maximizar'){
                echo"<td>Z</td>";    
            }elseif($x==$linhas&&$_SESSION['problema']=='Minimizar'){
                echo"<td>-Z</td>";    
            }else{
                echo"<td>F".$f."</td>";
            }
            for($y =0;$y<$colunas; $y++){    
                echo"<td><input type='number' step=0.0001 class='form-control' name='basico[".$x."][".$y."]'/></td>";
                }   
            echo"<td>".$problema."</td>";
            echo"<td><input type='number' step=0.0001 class='form-control' name='basico[".$x."][".$colunas."]'/></td>";
            echo"<td><input type='text' class='form-control col-xl' name='descricao_F[".$x."]'/></td>";
            }?>
        </tr>
            </tbody>
        </table> 
    </div>
    <div class="4ol-6">
        <button class="btn btn-lg btn-info btn-block" type="submit">Calcular</button>
    </div>
    <form>
  </body>
</html>
