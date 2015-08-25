<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07/08/2015
 * Time: 14:48
 */

class Tipo_Ref {
    private $id;
    private $descricao;

    function setId($id){
      $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    function getDescricao(){
        return $this->descricao;
    }



}