<?php

/*
 *

  /**
 * clase que me permite crear un numero Racional y operar con el
 *
 * @author luisafernandez
 */

class Racional {

    private $num; //el numerador
    private $den; //el denominador

    function __construct($entrada) {//el objeto racional se crea con la entrada del index
        if ((preg_match("/[-]?[1-9][0-9]*[\/][-]?[1-9][0-9]*/ ", $entrada))) {//esta opción es si la entrada cumple los requisitos de fracción
            $post = $this->separarFraccion($entrada); //encuentro la posicion del la barra de la fracción
            $this->num = substr($entrada, 0, ($post - 1)); //a la izquierda el numerador
            $this->den = substr($entrada, $post); //a la derecha el denominador
        } else {//si el denominador es 1 el numerador sera la entrada.Doy por echo que ya filtro la entrada a traves del index, es decir
            //cuando se crea un número racional es porque vengo de operación racional.
            $this->num = $entrada; //
            $this->den = 1;
        }
    }

    function getN() {
        return $this->num;
    }

    function getD() {
        return $this->den;
    }

    public function __call($name, $arguments) {//este método es poder instanciar objetos en la clase OperacionRacional
        switch ($name) {
            case 'asignar':
                $this->__construct($arguments[0], $arguments[1]);
                break;
            default:
                return false;
        }
    }

    private function separarFraccion($fraccion) {//fución para separar la fracción
        $elemento = preg_split("/[\/]/", $fraccion, null, PREG_SPLIT_OFFSET_CAPTURE);
        $pos = $elemento[1][1];
        return $pos;
    }

    private static function mcd($a, $b) {//con esta función calculo el mcd
        $mayor = ($a > $b) ? $a : $b; //tengo que saber que entrada es la mayor y la menor
        $menor = ($a > $b) ? $b : $a;
        while ($mayor % $menor !== 0) {
            $c = $menor;
            $menor = $mayor % $menor;
            $mayor = $c;
        } return $menor;
    }

    private static function simplificar($a, $b) {//esta función es para simplificar
        $num = $a;
        $den = $b;
        if ($a == $b) {
            return "1"; //si el denominador es igual que el númerador el número es 1
        }
        if (self::mcd($a, $b) !== 1) {//si no son primos entre si, lo simplifico
            $num = $a / self::mcd($a, $b);
            $den = $b / self::mcd($a, $b);
        }
        if ($den === 1) {//si el denominador queda 1, el número solo mostrará el denominador
            return $num;
        }
        return $num . "/" . $den;
    }

    public function sumar(Racional $r1): String {//el funcionamiento de estas funciones es siempre el mismo
        //opero y luego simplifico
        $num = $this->num * $r1->getD() + $this->den * $r1->getN();
        $den = $this->den * $r1->getD();
        return self::simplificar($num, $den); //he optado que lo que me devuelva estas funciones
        //sea un string, con la forma del resultado. No un número racional, ya que no me es necesario.
    }

    public function restar(Racional $r1): String {
        $num = $this->num * $r1->getD() - $this->den * $r1->getN();
        $den = $this->den * $r1->getD();
        return self::simplificar($num, $den);
    }

    public function multiplicar(Racional $r1): String {
        $num = $this->num * $r1->num;
        $den = $this->den * $r1->den;
        return self::simplificar($num, $den);
    }

    public function dividir(Racional $r1): String {
        $num = $this->num * $r1->den;
        $den = $this->den * $r1->num;
        return self::simplificar($num, $den);
    }

}
