<?php 
session_start();
$_SESSION['intera']=0;
$_SESSION['descricao_F']=$_POST['descricao_F'];
$_SESSION['descricao_X']=$_POST['descricao_X'];
$interacoes = $_SESSION['interacoes'];
$luc=1000;
$coluna;
$solucao_otima = false;
$solucao_inicial = $_POST['basico'];

echo 'Solucao Inicial';print_r($solucao_inicial);echo '<br>';
$numero_de_linhas = count($solucao_inicial)-1;
$coluna_variaveis = [];
for($i=1, $x=0;$x<$numero_de_linhas;$i++, $x++){//Criando a coluna de variaveis
    $coluna_variaveis[$x]='F'.$i;
}
echo 'Coluna de variaveis';print_r($coluna_variaveis);echo '<br>';//printando as variaveis iniciais ou seja, as variaveis de restrição
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
$_SESSION['valor_inicial']=$valor_inicial;//valor inicial da analise de sensibilidade
$solucao_parcial=[];//valor para tabela parcial
$_SESSION['inter']=0;//index da tabela parcial
$inter=0;
for($i = 0; $i < $interacoes; $i++){
    $_SESSION['index_final']=$i;//index da interação que chegou a solução ótima
    foreach($solucao_inicial[$numero_de_linhas] as $key=>$lucro){//localiza a coluna com o maior numero negativo
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

    $sai_da_base = [];
    foreach($entra_na_base as $key=>$e){
        $sai_da_base[$key]= $solucao_inicial[$key][$numero_de_colunas]/$e; //divide a coluna B pela coluna que entra na base
    }
    $var = 1000000;
    $linha;
    foreach($sai_da_base as $key=>$s){//verifica qual o quociente positivo é o menor
        if($s<$var && $s>0){
            $var=$s;
            $linha=$key;
        }
    }
    $X=$coluna+1;//numero da variavel de decisão a entrar na base
    $coluna_variaveis[$linha]= 'X'.$X;//insere na coluna de variaveis a coluna que entra na base
    $luc =0;
    $var = 1000;
    $pivo = $solucao_inicial[$linha][$coluna];

    foreach($solucao_inicial[$linha] as $key=>$a){
        $solucao_inicial[$linha][$key]=$a/$pivo;
    }

    $linha_que_entra = $solucao_inicial[$linha];

    $tabela_aux = [];
    foreach($solucao_inicial as $key=>$post){
        foreach($post as $key1=>$p){
            $tabela_aux[$key][$key1] = ($linha_que_entra[$key1]*(-1*$solucao_inicial[$key][$coluna]))+$p;
        }
    }
    $tabela_aux[$linha]=$solucao_inicial[$linha];
    $negativo = null;
    $solucao_inicial=$tabela_aux;
    $solucao_parcial[$inter]=$solucao_inicial;
    $inter++;
    foreach($solucao_inicial[$numero_de_linhas] as $key=>$p){
        if($p<0){
            $negativo = $p;
        }
    }
    if(isset($negativo)){ 
        $solucao_otima=false;
    }else{
        $solucao_otima=true;
        break;
    }
   $negativo=null;

}
$_SESSION['inter']=0;
$_SESSION['solucao_parcial']=$solucao_parcial;
$_SESSION['final'] = $solucao_inicial;
$_SESSION['coluna_variaveis'] = $coluna_variaveis;
header('Location: solucao_inicial.php');
?>