<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 10/08/2015
 * Time: 08:45
 */
class TipoRefList {
    private $tipo = array();
    private $tipoCount = 0;
    public function __construct() {
    }
    public function getTipoCount() {
        return $this->tipoCount;
    }
    private function setTipoCount($newCount) {
        $this->tipoCount = $newCount;
    }
    public function getTipo($tipoNumberToGet) {
        if ( (is_numeric($tipoNumberToGet)) &&
            ($tipoNumberToGet <= $this->getTipoCount())) {
            return $this->tipo[$tipoNumberToGet];
        } else {
            return NULL;
        }
    }
    public function addTipo(Tipo_Ref $tipo_in) {
        $this->setTipoCount($this->getTipoCount() + 1);
        $this->tipo[$this->getTipoCount()] = $tipo_in;
        return $this->getTipoCount();
    }
    public function removetipo(Tipo_Ref $tipo_in) {
        $counter = 0;
        while (++$counter <= $this->getTipoCount()) {
            if ($tipo_in->getAuthorAndTitle() ==
                $this->tipo[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getTipoCount(); $x++) {
                    $this->tipo[$x] = $this->tipo[$x + 1];
                }
                $this->settTipoCount($this->getTipoCount() - 1);
            }
        }
        return $this->getTipoCount();
    }
}