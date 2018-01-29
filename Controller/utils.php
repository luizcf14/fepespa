<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of utils
 *
 * @author admin
 */
class utils {

    
    public static function arrayUtf8Enconde(array $array) {
        $novo = array();
        foreach ($array as $i => $value) {
            if (is_array($value)) {
                $value = self::arrayUtf8Enconde($value);
            } elseif (!mb_check_encoding($value, 'UTF-8')) {//se não for array, verifica se o valor está codificado como UTF-8
                $value = utf8_encode($value);
            }
            $novo[$i] = $value;
        }
        return $novo;
    }

    
    public static function saidaJson($saida) {

        if(is_array($saida)){
            die(json_encode(self::arrayUtf8Enconde($saida)));
        }else{
            die(json_encode($saida));
        }
  }

    
    
}
