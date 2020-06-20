<?php
spl_autoload_register(function($clase) {
    require "$clase.php";
});
$msj1 = "Empezando";//los diferentes mensajes quq aparecen en pantalla
$tipo="Valores desconocidos";
$resultado="Introduce la operación";
if (isset($_POST['entrada'])) {
    $entrada = filter_input(INPUT_POST, 'entrada', FILTER_SANITIZE_STRING);
    $entrada = str_replace(' ', '', $entrada);//quito los espacios que haya podido introducir el usuario
    $tipoDeOperacion = Operacion::tipoOperacion($entrada);//esta función estática esta en operación 
    //nos dice el tipo de objeto que tendremos que crear

    switch ($tipoDeOperacion) {
        case 1:
            $tipo = "Operación Real";
            $operacion = new OperacionReal($entrada);
            $msj1 = $operacion;//he hecho el to string en forma de tabla
            $resultado=$operacion->getOp1(). " ". $operacion->getOperando() ."".$operacion->getOp2()." = " .$operacion->getResultado() ;//muestra la operación realizada
            break;
        case 2:
            $tipo = "Operación Racional";
            $operacion = new OperacionRacional($entrada);
            $msj1 = $operacion;
            $resultado=$operacion->getOp1(). " ". $operacion->getOperando() ."".$operacion->getOp2()." = ".$operacion->getResultado() ;
            break;
        case 3:
            $tipo = "No es una operación válida";//si no es una operacion vália vendrá aquí
            break;
        default:
            $msj1 = "No has introducido bien la operación a realizar, revisala";
            break;
    }
   
        
}
?>
<!DOCTYPE html>
<!--
 Luisa Fernandez 2 daw práctica calculadora
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="estilo.css" media="screen" />
    </head>
    <body>
        <fieldset id="ayuda">
            <legend>Reglas de uso de la calculadora</legend>
            <div id=texhelp> La calculadora se usa escribiendo la operación.</div>
            <div id=texhelp> La  operación será <strong>Operando_1 operación Operando_2</strong>.</div>
            <div id=texhelp> Cada operando puede ser número <strong>real  o racional.</strong></div>
            <div id=texhelp> Real p.e. <strong>5</strong> o <strong>5.12 </strong> Racional p.e <strong> 6/3 </strong>o<strong> 7/1</strong></div>
            <div id=texhelp> Los operadores reales permitidos son <strong><font size='5' color='red'> +  -  *  /</font></strong></div>
            <div id=texhelp> Los operadores racionales permitidos son <strong><font size='5' color='red'> +  -  *  :</font> </strong></div>
            <div id=texhelp> No se deben de dejar espacios en blanco entre operandos y operación</div>
            <div id=texhelp> Si un operando es real y el otro racional se considerará operación racional</label></div>
            <div id=texhelp> Ejemplo (Real)<strong>5.1+4</strong>  (Racional)<strong>5/1:2</strong>  (Error)<strong>5.2+5/1</strong> (Error)<strong>52214+</strong> </label></div>


        </fieldset>
        <fieldset id="meollo">
            <legend>Establece la operación</legend>
            <form action="index.php" method="POST">
                <label for="operacion">Operacion</label>
                <input type="text" name="entrada" id="">
                <input type="submit" name="enviar" value="Calcular">
                <label><?= $resultado ?><br /></label>
            </form>
        </fieldset>
        <fieldset id=rtdo><legend>Resultado</legend><label>

                <table border=1 >
                    <tr>
                        <th>Cocepto</th>
                        <th>Valores</th>
                    </tr>
                    <?= $msj1?>
                   <tr>
                        <th>Tipo de operacion  </th>
                        <th><?= $tipo ?>  </th>
                    </tr> 
                    

                </table></label></fieldset>




    </body>
</html>
