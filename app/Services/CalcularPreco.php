<?php
namespace App\Services;

use Illuminate\Http\Request;

class CalcularPreco
{
    public static function CalcularDistancia($lat1,$lon1,$lat2,$lon2)
    {
        try{
            $lat1 = deg2rad($lat1);
            $lat2 = deg2rad($lat2);
            $lon1 = deg2rad($lon1);
            $lon2 = deg2rad($lon2);
            
            $dist = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) + sin( $lat1 ) * sin($lat2) ) );
            $dist = number_format($dist, 2, '.', '');
            if($dist > 15){
               return array(
                    'distancia' => false,
                    'preco' => false
                ); 
            }else{
                return array(
                    'distancia' => $dist,
                    'preco' => self::CalcularPreco($dist)
                );   
            }
        }catch(\Exception $erro){
            return $erro->getMessage();
        }
    }
    
    private static function CalcularPreco($distancia){
        return ceil(number_format(($distancia * 5) + 50,2));
    }
}
