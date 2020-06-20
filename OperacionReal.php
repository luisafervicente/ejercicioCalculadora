<?php

/*
 *  | .
 */

/**
 * Description of Real
 *
 * @author  luisa fernanez
 */
class OperacionReal extends Operacion {//
    //todas las operaciones reales están aqui implementadas

    function __construct($operacion) {
        parent::__construct($operacion);
    }

    public function division() {
        $resultado = $this->op1 / $this->op2;
        return $resultado;
    }

    public function multiplicacion() {
        $resultado = $this->op1 * $this->op2;
        return $resultado;
    }

    public function resta() {
        $resultado = $this->op1 - $this->op2;
        return $resultado;
    }

    public function suma() {
        $res = $this->op1 + $this->op2;
        return $res;
    }

}

//put your code here
