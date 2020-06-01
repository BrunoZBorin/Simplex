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

    //coluna das variaveis
    $variaveis = [];
    for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      $variaveis[$i] = 'X'.$j;
    }
    for($i=$numero_decisoes, $x = 1; $x<=$numero_restricoes+1; $i++, $x++){
      if($x == $numero_restricoes+1){
        $variaveis[$i] = 'Lucro';  
      }else{
        $variaveis[$i] = 'F'.$x;
      } 
    }

    //coluna do tipo
    $tipo=[];
    for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      $tipo[$i] = 'Decisão';
    }
    for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes; $i++, $x++){
      if($x==$numero_restricoes){
        $tipo[$i] = 'Lucro';
      }else{
        $tipo[$i] = 'Restrição';
      }
    }
    
    //coluna do valor inicial
    $vlr_inicial = [];
    for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      $vlr_inicial[$i] = 0;
    }
    for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes+1; $i++, $x++){
      $vlr_inicial[$i] = $vlr_ini_restricoes[$x];
    }

    //coluna do valor final
    $vlr_final = [];
    $index_coluna_b = $numero_decisoes + $numero_restricoes;
    $coluna_b =[];
    for($x=0; $x<=$numero_restricoes;$x++){
      $coluna_b[$x] = $solucao_final[$x][$index_coluna_b];
    }
    $linhas = count($variaveis);
    for($i=0; $i<$linhas; $i++){
      for($j=0;$j<=count($coluna_variaveis);$j++){
        if($variaveis[$i]==$coluna_variaveis[$j]){
          $vlr_final[$i]=$coluna_b[$j];
          $j=count($coluna_variaveis);
        }else{
          $vlr_final[$i]=0;
        }
      }
    }
    //coluna var básica
    $var_basica = [];
    $coluna_b =[];
    for($x=0; $x<=$numero_restricoes;$x++){
      $coluna_b[$x] = $solucao_final[$x][$index_coluna_b];
    }
    for($i=0; $i<$linhas; $i++){
      for($j=0;$j<=count($coluna_variaveis);$j++){
        if($variaveis[$i]==$coluna_variaveis[$j]){
          $var_basica[$i]='SIM';
          $j=count($coluna_variaveis);
        }else{
          $var_basica[$i]='NÂO';
        }
      }
    }

    //escasso
    $escasso=[];
    for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      $escasso[$i] = '-';
    }
    for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes; $i++, $x++){
      if($x==$numero_restricoes){
        $escasso[$i] = '-';
      }elseif($vlr_final[$i]==0){
        $escasso[$i] = 'SIM';
      }else{
        $escasso[$i] = 'NÃO';
      }
    }
     //coluna sobra recurso
     $sobra_recurso=[];
     for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
       $sobra_recurso[$i] = '-';
     }
     for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes; $i++, $x++){
       if($x==$numero_restricoes){
         $sobra_recurso[$i] = '-';
       }else{
         $sobra_recurso[$i] = $vlr_final[$i];
       }
     }
     
     //coluna sobre o uso dos recursos
     $uso_recurso=[];
     for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
       $uso_recurso[$i] = '-';
     }
     for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes; $i++, $x++){
       if($x==$numero_restricoes){
         $uso_recurso[$i] = '-';
       }else{
         $uso_recurso[$i] = $vlr_inicial[$i]-$sobra_recurso[$i];
       }
     }

     //preço sombra
     $preco_sombra=[];
     for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      $preco_sombra[$i] = '-';
    }
    for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes; $i++, $x++){
      if($x==$numero_restricoes){
        $preco_sombra[$i] = '-';
      }else{
        $preco_sombra[$i] = $solucao_final[$numero_restricoes][$i];
      }
    }
    //custo reduzido
    $custo_reduzido=[];
    for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      if($var_basica[$i]=='SIM'){
        $custo_reduzido[$i] = 0;
      }elseif($var_basica[$i]=='NÂO'){
        $custo_reduzido[$i]=$solucao_final[$numero_restricoes][$i];
      }
   }
   for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes; $i++, $x++){
     if($x==$numero_restricoes){
       $custo_reduzido[$i] = '-';
     }else{
       $custo_reduzido[$i] = '-';
     }
   }
   //tabela parametros
   $vetor_aux=[];
  
    for($y=$numero_decisoes, $i=0; $i<$numero_restricoes;$y++, $i++){
      for($x=0; $x<$numero_restricoes;$x++){
        
        $vetor_aux[$x][$i] = $coluna_b[$x]/($solucao_final[$x][$y]*(-1));
      }
    }

  $aux_maior = 100000;
   //aumentar
   $aux_aumenta=[];
   for($x=0; $x<$numero_restricoes;$x++){
    for($y=0; $y<$numero_restricoes;$y++){
      if(($vetor_aux[$y][$x]<$aux_maior)&&($vetor_aux[$y][$x]>0)){
        $aux_maior=$vetor_aux[$y][$x];
      }
    }
    if($aux_maior != 100000){
      $aux_aumenta[$x]=$aux_maior;
      $aux_maior = 100000;
    }else{
      $aux_aumenta[$x]='INF';
    }
  }
  $aumentar_par=[];
     for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      $aumentar_par[$i] = '-';
    }
    for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes; $i++, $x++){
      if($x==$numero_restricoes){
        $aumentar_par[$i] = '-';
      }else{
        $aumentar_par[$i] = $aux_aumenta[$x];
      }
    }
    //reduzir
    $aux_menor=-100000;
    $aux_reduz=[];
   for($x=0; $x<$numero_restricoes;$x++){
    for($y=0; $y<$numero_restricoes;$y++){
      if(($vetor_aux[$y][$x]>$aux_menor)&&($vetor_aux[$y][$x]<0)){
        $aux_menor=$vetor_aux[$y][$x];
      }
    }
    if($aux_menor != -100000){
      $aux_reduz[$x]=$aux_menor;
      $aux_menor = -100000;
    }else{
      $aux_reduz[$x]='INF';
    }
  }
  $reduzir_par=[];
     for($i=0, $j=1; $i<$numero_decisoes; $i++, $j++){
      $reduzir_par[$i] = '-';
    }
    for($i=$numero_decisoes, $x = 0; $x<=$numero_restricoes; $i++, $x++){
      if($x==$numero_restricoes){
        $reduzir_par[$i] = '-';
      }else{
        $reduzir_par[$i] = $aux_reduz[$x];
      }
    }
    //Maximo
    $maximo = [];
    for($i=0; $i<$linhas; $i++){
      if($aumentar_par[$i]=='INF'){
        $maximo[$i]='INF';  
      }elseif($aumentar_par[$i]=='-'){
        $maximo[$i]='-';  
      }else{
        $maximo[$i]=$vlr_inicial[$i]+$aumentar_par[$i];
      }
    }
    //Minimo
    $minimo = [];
    for($i=0; $i<$linhas; $i++){
      if($reduzir_par[$i]=='INF'){
        $minimo[$i]='INF';  
      }elseif($reduzir_par[$i]=='-'){
        $minimo[$i]='-';  
      }else{
        $minimo[$i]=$vlr_inicial[$i]+$reduzir_par[$i];
      }
    }

?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Simplex</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>

  <body class="mx-5">
  <h3>Solução final</h3>
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
                echo"<td>Lucro</td>";    
            }else{
                echo"<td>".$coluna_variaveis[$x]."</td>";
            }
            for($y =0;$y<=$numero_de_colunas; $y++){    
              echo"<td>".$solucao_final[$x][$y]."</td>";
            }
            echo"</tr>";
        }?>
                  
        </tbody>
      </table>
  </div>

  <div class="row">
        <table class="table table-bordered">
        
        <thead>
            <tr>
            <th class="border border-primary">Variável</th>
            <th scope="col">Tipo</th>
            <th scope="col">Vlr Inicial</th>
            <th scope="col">Vlr Final</th>
            <th scope="col">Var Básica</th>
            <th scope="col">Escasso</th>
            <th scope="col">Sobra recurso</th>
            <th scope="col">Uso recurso</th>
            <th scope="col">Preço sombra</th>
            <th scope="col">Custo reduzido</th>
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
            <th scope="col"><?php echo $tipo[$x]?></th>
            <th scope="col"><?php echo $vlr_inicial[$x]?></th>
            <th scope="col"><?php echo $vlr_final[$x]?></th>
            <th scope="col"><?php echo $var_basica[$x]?></th>
            <th scope="col"><?php echo $escasso[$x]?></th>
            <th scope="col"><?php echo $sobra_recurso[$x]?></th>
            <th scope="col"><?php echo $uso_recurso[$x]?></th>
            <th scope="col"><?php echo $preco_sombra[$x]?></th>
            <th scope="col"><?php echo $custo_reduzido[$x]?></th>
            <th scope="col"><?php echo $aumentar_par[$x]?></th>
            <th scope="col"><?php echo $reduzir_par[$x]?></th>
            <th scope="col"><?php echo $maximo[$x]?></th>
            <th scope="col"><?php echo $minimo[$x]?></th>           
          <?php 
            echo"</tr>";
        }?>
        </tbody>
        </table>
    </div>
        </body>
</html>