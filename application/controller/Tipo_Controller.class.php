<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/08/2015
 * Time: 14:31
 */
include '../model/Tipo_DAO.class.php';

class Tipo_Controller{


    public function inserir(Tipo_Ref $tipo_Ref){
        $td = new Tipo_DAO();
        $teste = $td->inserir($tipo_Ref);
        return $teste;
    }


    public function alterar(Tipo_Ref $tipo_Ref){
        $td = new Tipo_DAO();
        $teste = $td->alterar($tipo_Ref);
        return $teste;
    }

    public function excluir($cod){
        $td = new Tipo_DAO();
        $teste = $td->delete($code);
        return $teste;
    }

    public function listarTipo($desc, $codigo){
        $td = new Tipo_DAO();
        $lista = $td->listaTipo($desc, $codigo);
        return $lista;
    }

    public function getSequencia(){
        $td = new Tipo_DAO();
        $codigo = $td->getSequencia();
        return $codigo;
    }

    public function recuperarTipo($codigo){
        $td = new Tipo_DAO();
        $tipo = $td->recuperarTipo($codigo);
        return $tipo;
    }

    public function totaReg (){
        $td = new Tipo_DAO();
        $total = $td->totalReg();
        return $total;
    }



}