<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/08/2015
 * Time: 08:40
 */
include 'ConnectionFactory.class.php';
include_once '../beans/Tipo_Ref.class.php';
include_once '../services/TipoRefList.class.php';
include_once '../services/TipoListIterator.class.php';

class Tipo_DAO{
    public function inserir(Tipo_Ref $tipoRef){
        $conn = new ConnectionFactory();
        $con = $conn->getConnection();
        $sql = "INSERT INTO DBAADV.NUT_TIPO (CDTIPO, DSTIPO)
                  VALUES
                  (:CD, :DESCR )";
        try{
            $cd = $tipoRef->getId();
            $desc = $tipoRef->getDescricao();
            $stmt = ociparse($con, $sql);
            oci_bind_by_name($stmt, ":CD", $cd);
            oci_bind_by_name($stmt, ":DESCR", $desc);
            oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
            $teste = true;
            $conn->closeConnection($con);
        }catch (PDOException $ex){
            echo "Erro: <br>".$ex->getMessage();
            $teste = false;
        }
        return $teste;
    }

    public function alterar(Tipo_Ref $tipoRef){
        $conn = new ConnectionFactory();
        $con = $conn->getConnection();
        $sql = "UPDATE DBAADV.NUT_TIPO SET DSTIPO = :DESCR WHERE CDTIPO = :CD";
        try{
            $cd = $tipoRef->getId();
            $desc = $tipoRef->getDescricao();
            $stmt = ociparse($con, $sql);
            oci_bind_by_name($stmt, ":CD", $cd);
            oci_bind_by_name($stmt, ":DESCR", $desc);
            oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
            $teste = true;
            $conn->closeConnection($con);
        }catch (PDOException $ex){
            echo "Erro: <br>".$ex->getMessage();
            $teste = false;
        }
        return $teste;
    }
   public function delete($code){
       $conn = new ConnectionFactory();
       $con = $conn->closeConnection();
       $sql_delete = "DELETE FROM DBAADV.NUT_TIPO WHERE ROWID = :CD ";
       $sql_line = "SELECT ROWID FROM DBAADV.NUT_TIPO T WHERE T.CDTIPO = :CD ";
       try{
           $stmt = oci_parse($con, $sql_line);
           oci_bind_by_name($stmt, ":cdp", $code);
           $rowid = oci_new_descriptor($con, OCI_D_ROWID);
           oci_define_by_name($stmt, "ROWID", $rowid);
           oci_execute($stmt);
           while(oci_fetch($stmt)){
               $nrow = oci_num_rows($stmt);
               $delete = oci_parse($con, $sql_delete);
               oci_bind_by_name($delete, ":CD", $rowid, -1, OCI_B_ROWID);
               oci_execute($delete, OCI_COMMIT_ON_SUCCESS);
           }
           $teste  = true;
           $conn->closeConnection($con);
       }catch(PDOException $ex){
           echo "Erro: <br>".$ex->getMessage();
           $teste = true;
       }

   }


    public function listaTipo($desc, $codigo){
        $lista = new TipoRefList();
        $conn = new ConnectionFactory();
        $connection = $conn->getConnection();
        try {
            if($desc != ""){
                $sql_text = "SELECT
                            T.CDTIPO
                          , T.DSTIPO
                          FROM
                          DBAADV.NUT_TIPO T WHERE T.DSTIPO LIKE :DESCR
                          ORDER BY T.CDTIPO";

                $statement = oci_parse($connection, $sql_text);
                $variavel = "%".$desc."%";
                oci_bind_by_name($statement, ":DESCR", $variavel);
            }
            else if ($codigo !=  0){
                $sql_text = "SELECT
                            T.CDTIPO
                          , T.DSTIPO
                          FROM
                          DBAADV.NUT_TIPO T  WHERE T.CDTIPO = :CODIGO
                          ORDER BY T.CDTIPO";

                $statement = oci_parse($connection, $sql_text);
                oci_bind_by_name($statement, ":CODIGO", $desc);
            }
            else{
                $sql_text = "SELECT
                            T.CDTIPO
                          , T.DSTIPO
                          FROM
                          DBAADV.NUT_TIPO T
                          ORDER BY T.CDTIPO";
                $statement = oci_parse($connection, $sql_text);
            }
            oci_execute($statement);
            while($row = oci_fetch_array($statement, OCI_ASSOC)){
                $tipo = new Tipo_Ref();
                $tipo->setId($row["CDTIPO"]);
                $tipo->setDescricao($row["DSTIPO"]);

                $lista->addTipo($tipo);
            }
            $conn->closeConnection($connection);

        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $lista;
    }


    public function getSequencia(){
        $cd = 0;
        $conn = new ConnectionFactory();
        $connection = $conn->getConnection();
        $sql_text = "SELECT DBAADV.NUT_TIPO_SEQ.NEXTVAL CODIGO FROM SYS.DUAL";
        try {
            $statement = oci_parse($connection, $sql_text);
            oci_execute($statement);
            while($row = oci_fetch_array($statement, OCI_ASSOC)){
                $cd = $row["CODIGO"];
            }
        } catch (PDOException $ex) {
            echo "Erro: ".$ex;
        }
        return $cd;
    }

    public function recuperarTipo($codigo){
        $conn = new ConnectionFactory();
        $tipo = null;
        $connection = $conn->getConnection();
        $sql_text = "SELECT T.CDTIPO, T.DSTIPO
                    FROM DBAADV.NUT_TIPO T WHERE T.CDTIPO = :cod";

        try {
            $statement = ociparse($connection, $sql_text);
            oci_bind_by_name($statement, ":cod", $codigo, -1);
            oci_execute($statement);
            while($row = oci_fetch_array($statement, OCI_ASSOC)){
                $tipo = new Tipo_Ref();
                $tipo->setDescricao($row["DSTIPO"]);

            }
            $conn = oci_close($connection);
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $tipo;
    }

    public function totalReg(){
       $conn = new ConnectionFactory();
       $total = 0;
       $connection = $conn->getConnection();
       $sql =  "SELECT * FROM DBAADV.NUT_TIPO";
       try{
           $statement = ociparse($connection, $sql);
           oci_execute($statement);
           while($row = oci_fetch_array($statement, OCI_ASSOC)){
               $total++;
           }
           $conn = oci_close($connection);

       }catch (PDOException $ex){
            echo "Erro: ".$ex->getMessage();
        }
        return $total;
      }
}
