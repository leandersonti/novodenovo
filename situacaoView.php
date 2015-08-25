<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Aviso de SEPSE!!!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta HTTP-EQUIV="refresh" CONTENT="15"> 
        <link rel="stylesheet" type="text/css" href="public/style/situacao.css">
        <link rel="shortcut icon" href="public/img/ham.ico">
        <script type="text/javascript">

                 function stop() {
                     document.embeds[0].stop();
                 }
        </script>

               
    </head>
      <body >
           <div id=tab >
                          <div id=tabela >
                               <table border=0 width=99% onload=chamaphp()>
                                       <tr id=titulo>
                                           <td ></TD><TD>PACIENTE</TD><TD>CIRURGI&Atilde;O</TD><TD align="center">SITUA&Ccedil;&Atilde;O</TD>
                                      </tr>
                                        <tbody>          
                                        <?php

                                            /* @var $pagina type */
                                            if(!isset($_GET['pagina']))
                                            {
                                                $pagina = 1;
                                            }  
                                            else{
                                                $pagina = $_GET['pagina'];
                                            }
                     
                     
                                            // bloco 2 - defina o número de registros exibidos por página
                                            $num_por_pagina = 30; 

                                            // bloco 3 - descubra o número da página que será exibida
                                            // se o numero da página não for informado, definir como 1
                                            session_start();
                                            
                                            
                                            
                                                
                                              
                                              
                                            
                                            
                                            // bloco 4 - construa uma cláusula SQL "SELECT" que nos retorne somente os registros desejados
                                            // definir o número do primeiro registro da página. Faça a continha na calculadora que você entenderá minha fórmula.
                                            $primeiro_registro = ($pagina*$num_por_pagina) - $num_por_pagina;

                                             // consulta apenas os registros da página em questão utilizando como auxílio a definição LIMIT. Ordene os registros pela quantidade de pontos, começando do maior para o menor DESC.


                                             /* 
                                             * To change this license header, choose License Headers in Project Properties.
                                             * To change this template file, choose Tools | Templates
                                             * and open the template in the editor.
                                             */

                                            require 'Situacao_Controller.class.php';
                                            #require 'SituacaoPaciente.class.php'; 
                                            #require 'SituacaoList.class.php';
                                            #require 'SituacaoListIterator.class.php';
                                            $dao = new Situacao_Controller();


                                            $total = $dao->recuperarTotal();
                                            $refresh = "";
                                           // echo "total: $total  Numero por pagina: $num_por_pagina";
                                            if($total > $num_por_pagina){
                                                 if(!isset($_SESSION['pagina'])){
                                                 $pagina = 1;
                                                 $_SESSION['pagina'] = $pagina ;
                                             }  else{
                                                 if( $_SESSION['pagina'] == 1){
                                                     $pagina = 2;
                                                     $_SESSION['pagina'] = $pagina ;
                                                 }
                                                 else {
                                                     $pagina = 1;
                                                     $_SESSION['pagina'] = $pagina;
                                                     
                                                 }
                                             }
                                                
                                                
                                                if($pagina == 1){
                                                $rs = $dao->lista($primeiro_registro, $num_por_pagina);
                                              //  $refresh = "refresh:20; url={$_SERVER['PHP_SELF']}?pagina=2" ;
                                                header($refresh);
                                                
                                                }else{
                                                        $rs = $dao->lista($num_por_pagina+1, $total);
                                                        /*echo '<meta http-equiv="refresh" content="6" />';
                                                        $refresh = "refresh:6; url={$_SERVER['PHP_SELF']}?pagina=1" ;
                                                        header($refresh);*/
                                                        

                                                }
                                            
                                                    $total_paginas = $total / $num_por_pagina;
                                                    $prev = 1;
                                                    $next = 2;
                                                    
                                                                if ($pagina > 1) {
                                                                    $prev_link = "<a href='{$_SERVER['PHP_SELF']}?pagina=$prev' >Anterior</a>";

                                                                    } else { // senão não há link para a página anterior

                                                                    $prev_link = "Anterior";

                                                                    }


                                                    // se número total de páginas for maior que a página corrente, então temos link para a próxima página
                                                  if ($total_paginas > $pagina) {
                                                  $next_link = "<a href='{$_SERVER['PHP_SELF']}?pagina=$next' >Próxima</a>";
                                                  } else { // senão não há link para a próxima página
                                                  $next_link = "Próxima";

                                                  }

                                                  // vamos arredondar para o alto o número de páginas que serão necessárias para exibir todos os registros. Por exemplo, se temos 20 registros e mostramos 6 por página, nossa variável $total_paginas será igual a 20/6, que resultará em 3.33. Para exibir os 2 registros restantes dos 18 mostrados nas primeiras 3 páginas (0.33), será necessária a quarta página. Logo, sempre devemos arredondar uma fração de número real para um inteiro de cima e isto é feito com a função ceil().
                                                  //echo "onload=chamaphp()";
                                                  $total_paginas = ceil($total_paginas);
                                                  $painel = "";
                                                  for ($x=1; $x<=$total_paginas; $x++) {
                                                    if ($x==$pagina) { // se estivermos na página corrente, não exibir o link para visualização desta página
                                                      $painel .= " [$x] ";
                                                    } else {
                                                      $painel .= " <a href='{$_SERVER['PHP_SELF']}?pagina=$x'>[$x]</a>";
                                                    }
                                                  }






                                            // exibir painel na tela
                                            echo "$prev_link | $painel | $next_link";

                                            }else{
                                             //   echo 'não é maior que o total';
                                                $rs = $dao->lista($primeiro_registro, $num_por_pagina);
                                                echo '<meta http-equiv="refresh" content="10" />';
                                            }
                                            
                                            // se página maior que 1 (um), então temos link para a página anterior

                                            $i = 0;
                                            $spList = new SituacaoListIterator($rs);
                                            $sp = new SituacaoPaciente();
                                            $paciente = new Paciente();
                                            
                                     
                                           while($spList->hasNextSituacao()){
                                                $i++;
                                               $sp = $spList->getNextSituacao();
                                              if($i % 2 == 0){
                                                  $par = "#d5e6ef";
                                              }else{
                                                  $par = "#ffffff";
                                              }  
                                              //"<img src=../../public/img/vermelha.gif>";
                                            //  echo $sp->getSituacao()."<br>";
                                              $status = substr($sp->getSituacao(), 2,35);
                                              $ordem = substr($sp->getSituacao(), 0,1);
                                             /* switch ($ordem){
                                                  case "1":
                                                      $imagem = "<a href=# onClick='stop();'> <img src=public/img/salcir.png width=29 height=29> </a>";
                                               */       $cor = "#fa0000";
                                                      
                                                /*     <!--<embed src="public/audio/preview2.mp3" hidden="true" type="audio/mp3" autostart="true"></embed>-->
                                                   <!--  <audio controla controls>
                                                            <source src="public/audio/preview2.mp3">
                                                     </audio>
                                                  */  
                                          /*            break;
                                                  case "2":
                                                      $imagem = "<img src=public/img/aguard.png width=29 height=29>";
                                                      $cor = "#fbad30";
                                                      break;
                                                  case "3":
                                                      $imagem = "<img src=public/img/salapos.png width=29 height=29>";
                                                      $cor = "#0098da";
                                                      break;
                                                  case "4":
                                                      $imagem = "<img src=public/img/alta.png width=29 height=29>";
                                                      $cor = "#286f45";
                                                      break;
                                                  default:
                                                      $imagem = "<img src=public/img/vermelha.gif width=29 height=29>";
                                                      break;
                                                  
                                              }*/
                                           //   echo "imagem = ".$imagem.", situacao = ".$ordem."<br>";
                                                
                                                if($sp->getSnCiente() == 'S'){
                                                    $checked = 'checked';
                                                    $cor = '#fff';   
                                                    $white = 'white';
                                                    $par = 'red';
                                                }
                                                else{
                                                    $checked = '';
                                                }
                                                echo "<tr bgcolor=$par id=fundoc".$i.">";
                                                #echo "<td align=center><a href='#'><img id=$i src=public/img/salcir.png width=29 height=29 onclick=mudaImagem();></a></td>";
                                                echo "<td> <INPUT TYPE=checkbox id=c".$i."  onclick='cbalterna(this)' NAME=OPCAO".$i." VALUE=".$sp->getAtendimento()." class=checkbox $checked> </td>";
                                                echo "<td><font color=$cor>".$sp->getPaciente()->getNome()."</font></td>";
                                                echo "<td>".$sp->getPrestador()."</td>";
                                                echo "<td align=center> <font color=$cor>".$status."</font></td>";        
                                                echo "</tr>";
                                                
                                            }
                                        
                                            
                       
                    ?>
                                            <tbody>              
                      </table>    
                  </div>

           </div>
           
                <script type="text/javascript">
                    function cbalterna(cb) {
                    
                    elemento = document.getElementById("fundo"+cb.id);
					if (cb.checked){
                    elemento.style.backgroundColor =  "#ed0909";			}else{
              	elemento.style.backgroundColor = "#fff";
					//document.write(<?php $cor='black'?>
                    }
					
                    
                </script>                             
                 <script type="text/javascript">
                   // function corFonte(cb) {
					
                    
                    //elemento = document.getElementById("fundo"+cb.id);
				/*	if (cb.checked){
                  //  elemento.style.color = cb.checked ? "#ed0909" : "#fff";
			elemento.style = "#ed0909";
                    
                    }else{
						elemento.style = "#fff";
						
					}
					}*/
                </script>     
          </body>
                           
           
</html>
