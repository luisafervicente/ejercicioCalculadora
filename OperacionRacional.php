<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OperacionRacional
 *
 * @author luisa fernandez
 */
class OperacionRacional extends Operacion {

    function __construct($operacion) {
        parent::__construct($operacion);
    }

//aquí estarán las operaciones de racional


    function multiplicacion() {//en cada operación creo un dos números racionales
        //para poder operar con ellos
        $r1 = new Racional($this->op1);
        $r2 = new Racional($this->op2);
        $resultado = $r1->multiplicar($r2); //esta operación viene de la clase Racional
        return $resultado;
    }

    public function resta() {
        $r1 = new Racional($this->op1);
        $r2 = new Racional($this->op2);
        $resultado = $r1->restar($r2);
        return $resultado;
    }

    public function suma() {
        /* @var $resutado type */
        $r1 = new Racional($this->op1);
        $r2 = new Racional($this->op2);
        $resultado = $r1->sumar($r2);
        return $resultado;
    }

    public function division() {
        $r1 = new Racional($this->op1);
        $r2 = new Racional($this->op2);
        $resultado = $r1->dividir($r2);
        return $resultado;
    }

}
