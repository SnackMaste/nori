<?php 
class Monedas {
    public function moneda($pais){
        if($pais == "COLOMBIA"){return "COP";};
        if($pais == "VENEZUELA"){return "VES";};
        if($pais == "ECUADOR"){return "USD";};
        if($pais == "CHILE"){return "CLP";};
        if($pais == "PERÚ"){return "PEN";};
    }

    public function formatearValor($valor,$moneda){
        if($moneda == "COP" || "CLP"){
            $valorFormateado = number_format($valor, 0, '', '.');
            return $valorFormateado;
        };
        if($moneda == "USD" || $moneda == "VES" || $moneda == "PEN"){
            $valorFormateado = number_format($valor,2,',','.');
            return $valorFormateado;
        };
    }

    public function puntoPorCompra($moneda){
        if($moneda == "COP"){
            $puntoPorCompra = 5000;
            return $puntoPorCompra;
        }
        if($moneda == "VES"){
            $puntoPorCompra = 46.92;
            return $puntoPorCompra;
        }
        if($moneda == "USD"){
            $puntoPorCompra = 1.30;
            return $puntoPorCompra;
        }
        if($moneda == "CLP"){
            $puntoPorCompra = 1250;
            return $puntoPorCompra;
        }
        if($moneda == "PEN"){
            $puntoPorCompra = 4.80;
            return $puntoPorCompra;
        }
    }

    public function valorPunto($moneda){
        if($moneda == "COP"){
            $valorPunto = 50;
            return $valorPunto;
        }
        if($moneda == "VES"){
            $valorPunto = 0.47;
            return $valorPunto;
        }
        if($moneda == "USD"){
            $valorPunto = 0.01;
            return $valorPunto;
        }
        if($moneda == "CLP"){
            $valorPunto = 12;
            return $valorPunto;
        }
        if($moneda == "PEN"){
            $valorPunto = 0.05;
            return $valorPunto;
        }
    }
}
