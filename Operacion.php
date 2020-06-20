<?php

/**
 * Clase abastracta
 *
 * @author luisa fernandez
 */
abstract class Operacion {

    protected $op1;
    protected $op2;
    protected $operador;
    protected $resultado;

    function __construct($operacion) {
        $post = $this->saberOperador($operacion); //el método saber operador determina donde esta el operador
        //con eso prodremos dividir la entrada en las diferentes partes y
        //construir un objeto operación.
        $this->operador = $operacion[$post - 1];
        $this->op1 = substr($operacion, 0, ($post - 1));
        $this->op2 = substr($operacion, $post);
        $this->resultado = $this->hacerOperacion(); //el resultado dependerá de la
        //operación que hagamos.
    }

    function __toString() {//la salida de la información del objeto será en tipo tabla
        return "<tr>
                        <th>Operando 1</th>
                        <th>" . $this->op1 . "</th>
                    <tr>
                        <th>Operando 2 </th>
                        <th>" . $this->op2 . "</th>
                    </tr>
                    <tr>
                        <th>Operación </th>
                        <th>" . $this->operador . "</th></tr>

                    <tr>
                        <th>Resultado </th>
                        <th>" . $this->resultado . "</th>
                    </tr>";
    }

    function getOp1() {
        return $this->op1;
    }

    function getOp2() {
        return $this->op2;
    }

    function getOperando() {
        return $this->operador;
    }

    function getResultado() {
        return $this->resultado;
    }

    abstract function division();

    abstract function suma();

    abstract function resta();

    abstract function multiplicacion();

    static public function tipoOperacion($entrada) {//funcion para saber el tipo de objeto que hay que crear, la llamo
        //en el index
        $num_ent = "[0-9][0-9]*";
        $num_real = "[0-9][0-9]*(\.[0-9][0-9]*)?";
        $op_real = "[\+\-\*\\/]";
        $op_racional = "[\+\-\*\:]";
        $num_racional = "[1-9][0-9]*[\/][1-9][0-9]*";

        if (preg_match("/^$num_real$op_real$num_real$/", $entrada)) {
            return 1; //es una oparcion real
        } else if (preg_match("/^$num_racional$op_racional$num_racional$/", $entrada)) {
            return 2; //es una operacion racional;
        } else if ((preg_match("/^$num_ent$op_racional$num_racional$/", $entrada)) || (preg_match("/^$num_racional$op_racional$num_ent$/", $entrada))) {
            return 2;
        }   //no es una operacion válida;
        else {

            return 3;
        }
    }

    protected function saberOperador($op) {
        if ($this->tipoOperacion($op) === 1) {
            $elemento = preg_split("/[\+\-\*\/]/", $op, null, PREG_SPLIT_OFFSET_CAPTURE);
            $pos = $elemento[1][1];
            return $pos;
        } else if ($this->tipoOperacion($op) == 2) {
            $elemento = preg_split("/[\+\-\*\:]/", $op, null, PREG_SPLIT_OFFSET_CAPTURE);
            $pos = $elemento[1][1];
            return $pos;
        }
    }

    public function hacerOperacion() {
        switch ($this->operador) {
            case'+':
                $msj = $this->suma();
                break;
            case'-':
                $msj = $this->resta();

                break;
            case'*':
                $msj = $this->multiplicacion();

                break;
            case'/':
                $msj = $this->division();
                break;
            case':':
                $msj = $this->division();
                break;
            default:
                $msj = "La entrada no es una operación válida";
                break;
        }
        return $msj;
    }

}
