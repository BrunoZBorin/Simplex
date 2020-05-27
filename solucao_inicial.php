<?php
    session_start();
    $teste = $_SESSION['valores'];
    echo $_SESSION['quant_var_decisao'];
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
                <th>BASE</th>
                <th>X1</th>
                <th>X2</th>
                <?php if($_POST['quant_var_decisao']==='3'):?>
                    <th>X3</th>
                <?php endif ?>
                <th>F1</th>
                <th>F2</th>
                <?php if(($_POST['quant_var_restricao']==='3')||($_POST['quant_var_restricao']==='4')):?>
                    <th>F3</th>
                <?php endif ?>
                <?php if($_POST['quant_var_restricao']==='4'):?>
                    <th>F4</th>
                <?php endif ?>
                <th>B</th>
                <th class="restricao">Restrição<th>
            </thead>
            <tbody>
                <tr>
                    <td name="basico[0][F1]">F1</td>
                    <td><input type="number" step=".0001"class="form-control" name="basico[0][0]"/></td>
                    <td><input type="number" step=".0001"class="form-control" name="basico[0][1]"/></td>
                    <?php if($_POST['quant_var_decisao']==='3'):?>   
                        <td><input type="number"step=".0001", class="form-control" name="basico[0][2]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001"class="form-control" name="basico[0][3]"/></td>
                    <td><input type="number" step=".0001"class="form-control" name="basico[0][4]"/></td>
                    <?php if(($_POST['quant_var_restricao']==='3')||($_POST['quant_var_restricao']==='4')):?>
                        <td><input type="text" step=".0001" class="form-control" name="basico[0][5]"/></td>
                    <?php endif ?>
                    <?php if($_POST['quant_var_restricao']==='4'):?>
                       <td><input type="text" step=".0001"class="form-control" name="basico[0][6]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001"class="form-control" name="basico[0][B]"/></td>
                    <td><input type="text" step=".0001"class="form-control" name="descricao"/></td>
                </tr>
                <tr>
                    <td name="basico[1][F2]">F2</td>
                    <td><input type="number" step=".0001"class="form-control" name="basico[1][0]"/></td>
                    <td><input type="number" step=".0001"class="form-control" name="basico[1][1]"/></td>
                    <?php if($_POST['quant_var_decisao']==='3'):?>   
                        <td><input type="number" step=".0001"class="form-control" name="basico[1][2]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001"class="form-control" name="basico[1][3]"/></td>
                    <td><input type="number" step=".0001"class="form-control" name="basico[1][4]"/></td>
                    <?php if(($_POST['quant_var_restricao']==='3')||($_POST['quant_var_restricao']==='4')):?>
                        <td><input type="text" class="form-control" name="basico[1][5]"/></td>
                    <?php endif ?>
                    <?php if($_POST['quant_var_restricao']==='4'):?>
                       <td><input type="text" class="form-control"name="basico[1][6]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001" class="form-control" name="basico[1][B]"/></td>
                    <td><input type="text" class="form-control" name="descricao"/></td>
                </tr>
                <?php if(($_POST['quant_var_restricao']==='3')||($_POST['quant_var_restricao']==='4')):?>
                <tr>
                    <td name="basico[3][F3]">F3</td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[2][0]"/></td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[2][1]"/></td>
                    <?php if($_POST['quant_var_decisao']==='3'):?>   
                        <td><input type="number" step=".0001" class="form-control" name="basico[2][2]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001" class="form-control" name="basico[2][3]"/></td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[2][4]"/></td>
                    <?php if(($_POST['quant_var_restricao']==='3')||($_POST['quant_var_restricao']==='4')):?>
                        <td><input type="text" class="form-control" name="basico[2][5]"/></td>
                    <?php endif ?>
                    <?php if($_POST['quant_var_restricao']==='4'):?>
                       <td><input type="text" class="form-control" name="basico[2][6]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001" class="form-control" name="basico[2][B]"/></td>
                    <td><input type="text" class="form-control" name="descricao"/></td>
                </tr>
                <?php endif ?>
                <?php if($_POST['quant_var_restricao']==='4'):?>
                <tr>
                    <td name="basico[4][F4]">F4</td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[3][0]"/></td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[3][1]"/></td>
                    <?php if($_POST['quant_var_decisao']==='3'):?>   
                        <td><input type="number" step=".0001" class="form-control" name="basico[3][2]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001" class="form-control" name="basico[3][3]"/></td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[3][4]"/></td>
                    <?php if(($_POST['quant_var_restricao']==='3')||($_POST['quant_var_restricao']==='4')):?>
                        <td><input type="text" class="form-control" name="basico[3][5]"/></td>
                    <?php endif ?>
                    <?php if($_POST['quant_var_restricao']==='4'):?>
                       <td><input type="text" class="form-control" name="basico[3][6]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001" class="form-control" name="basico[3][B]"/></td>
                    <td><input type="text" class="form-control" name="descricao"/></td>
                </tr>
                <?php endif ?>
                <tr>
                    <td name="basico[4][Lucro]">LUCRO</td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[4][0]"/></td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[4][1]"/></td>
                    <?php if($_POST['quant_var_decisao']=='3'):?>   
                        <td><input type="number" step=".0001" class="form-control" name="basico[4][2]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001" class="form-control" name="basico[4][3]"/></td>
                    <td><input type="number" step=".0001" class="form-control" name="basico[4][4]"/></td>
                    <?php if(($_POST['quant_var_restricao']=='3')||($_POST['quant_var_restricao']=='4')):?>
                        <td><input type="text" class="form-control" name="basico[4][5]"/></td>
                    <?php endif ?>
                    <?php if($_POST['quant_var_restricao']=='4'):?>
                       <td><input type="text" class="form-control"name="basico[4][6]"/></td>
                    <?php endif ?>
                    <td><input type="number" step=".0001" class="form-control" name="basico[4][B]"/></td>
                    <td><input type="text" class="form-control" name="descricao"/></td>
                </tr>   

            </tbody>
        </table>    </div>
    <div class="4ol-6">
        <button class="btn btn-lg btn-info btn-block" type="submit">Calcular</button>
    </div>

<form>

  </body>
</html>