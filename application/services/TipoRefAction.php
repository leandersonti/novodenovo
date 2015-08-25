<meta charset="UTF-8">
<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/08/2015
 * Time: 09:48
 */

include "../controller/Tipo_Controller.class.php";

$acao = $_POST['a'];
//echo "Tipo acao = ".$acao;
$descricao = $_POST['descricao'];
echo $descricao;
$codigo = 0;
if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
}



//echo $acao;
switch($acao){
    case 1:

            inserir($descricao);

        break;
}


function inserir($descr){
   // echo "funcao inserir";
    $tc = new Tipo_Controller();
    $tipo = new Tipo_Ref();
    $codigo = $tc->getSequencia();
    $tipo->setId($codigo);
    $tipo->setDescricao(strtoupper($descr));
    $teste = $tc->inserir($tipo);
    if($teste){
      /*  echo "<script type='text/javascript'>
                           alert('Salvo com suscesso!');
                           location.href='../view/dados_refeicoes.php';
              </script>";
      */
        echo "Salvou";
    }else{
        echo "nao salvou";
    }
}