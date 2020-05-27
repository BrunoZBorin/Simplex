<?php 
session_start();



$interacoes = 3;
$luc=1000;
$coluna;
$solucao_otima = false;
$solucao_inicial = $_POST['basico'];
$numero_de_linhas = count($solucao_inicial)-1;
$numero_de_colunas = count($solucao_inicial[0])-1;
echo 'Numero de linhas'.$numero_de_linhas;
echo 'Numero de colunas'.$numero_de_colunas.'<br>';
echo 'Interacoes'.$interacoes.'<br>';
$_SESSION['numero_de_linhas']=$numero_de_linhas;
$_SESSION['numero_de_colunas']=$numero_de_colunas;
$valor_inicial = [];
foreach($solucao_inicial as $key=>$e){
    $valor_inicial[$key] = $e[$numero_de_colunas];
}
$_SESSION['valor_inicial']=$valor_inicial;

for($i = 0; $i < $interacoes; $i++){
    foreach($solucao_inicial[$numero_de_linhas] as $key=>$lucro){
        if($lucro<$luc){
            $luc=$lucro;
            $coluna=$key;
        }
        
    }

    $tmp = null;
    foreach($solucao_inicial as $key=>$value[$coluna]){
        $tmp[] = $key;
    }
    $entra_na_base = [];
    foreach($tmp as $key=>$e){
            $entra_na_base[$key] = $solucao_inicial[$e][$coluna];
    }
    echo '<br>entra na base: '.print_r($entra_na_base);echo '<br>';

    $sai_da_base = [];
    foreach($entra_na_base as $key=>$e){
        $sai_da_base[$key]= $solucao_inicial[$key][$numero_de_colunas]/$e; 
    }
    $var = 1000;
    $linha;
    foreach($sai_da_base as $key=>$s){
        if($s<$var && $s>0){
            $var=$s;
            $linha=$key;
        }
    }


    echo 'menor valor: '.$var.'e o index eh: '.$linha;
    echo '<br>';
    echo 'coluna: '.$coluna;
    echo '<br>';    
    echo 'menor valor: '.$luc;
    echo '<br>';
    echo 'linha que sai da base';print_r($sai_da_base);
    echo '<br>';
    echo '<br>';
    echo '<br>';
    $luc =0;
    $var = 1000;
    $pivo = $solucao_inicial[$linha][$coluna];
    echo 'Pivo: '.$pivo;
    foreach($solucao_inicial[$linha] as $key=>$a){
        $solucao_inicial[$linha][$key]=$a/$pivo;
    }
    $linha_que_entra = $solucao_inicial[$linha];
    echo 'linha que entra na base';print_r($linha_que_entra);

    $tabela_aux = [];
    foreach($solucao_inicial as $key=>$post){
        foreach($post as $key1=>$p){
            $tabela_aux[$key][$key1] = ($linha_que_entra[$key1]*(-1*$solucao_inicial[$key][$coluna]))+$p;
        }
    }
    $tabela_aux[$linha]=$solucao_inicial[$linha];
    $negativo = null;
    $solucao_inicial=$tabela_aux;
    foreach($solucao_inicial[$numero_de_linhas] as $key=>$p){
        if($p<0){
            $negativo = $p;
        }
    }
    if(isset($negativo)){
        echo "<br>Variavel Negativa ".$negativo."<br>"; 
        $solucao_otima=false;
    }else{
        $solucao_otima=true;
        echo '<br>';
        echo '<br>';
        foreach($solucao_inicial as $key=>$s){
            print_r($s);
            echo '<br>';    
        }
        echo '<br>';
        echo '<br>';
        break;
    }
    echo '<br>';
    echo '<br>';
    foreach($solucao_inicial as $key=>$s){
        print_r($s);
        echo '<br>';    
    }
    echo '<br>';
    echo '<br>';
    $negativo=null;
    
}
$_SESSION['final'] = $solucao_inicial;
header('Location: tabela.php');
?>