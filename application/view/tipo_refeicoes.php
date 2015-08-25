<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="../../public/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../../public/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
    <link href="../../public/css/style.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="../../public/js/bootstrap.js"></script>


    <title>tipos de refeicoes</title>
</head>
<body>
<div class="container">

    <div class="row">

        <div class="span10 head">
            <h1 ALIGN="CENTER">TIPO DE REFEICOES</h1>

        </div>

    </div>

    <div class="row">

        <div class="span10 corpo">
            <?php
                $opcao = $_GET['o'];
                $caption = "";
                $codigo = 0;
                if($opcao == 1 ){
                    $caption = "Cadastrar Novo Tipo de Alimento";
                }
                else{
                    $caption = "Alterar Tipo de Alimento";

                    if(isset($_GET['c']))
                        $codigo = $_GET['codigo'];



                }

            ?>
            <form class="form-inline" name="formrefeicao" method="post" action="../services/TipoRefAction.php">
                <caption><?php echo $caption; ?></caption>
                <input type="hidden" name="a" value="<?php echo $opcao; ?>" />
                <input type="hidden" name="codigo" value="<?php echo $codigo; ?>" />

                <table border="0">

                    <tr>
                        <td height="50"> Descri&ccedil;&atilde;o </td> <td><input name="descricao" required="" style="text-transform:uppercase;"></td>
                    </tr>
                    <tr>
                       <td colspan="2" width="100" height="50"> <div align="center"><input type="submit" value="Salvar"> &nbsp;&nbsp; <input type="button" value="Cancelar"></div></td>
                    </tr>
                </table>


            </form>


        </div>

    </div>



</div>

</body>
</html>