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


    public static function formata_dinheiro($valor) {

        $valor = number_format($valor, 2, ',', '');

        return $valor;
    }

    public static function valida_data($data) {
            $data = preg_split( "/[-,\/]/", $data);
            
            if(!checkdate( $data[1], $data[0], $data [ 2]) and!checkdate( $data[1], $data[2], $data[0])) {
                return false;
            }
            
            return true;
    }

    /**
     * Utilizada para tanto para transformar as datas para serem inseridas no banco de dados
     * quanto para as trazer do banco e mostra-las corretamente.
     *
     *
     * @param date $data Data que será transformada
     *
     * @return
     * Date transformada.
     *
     * Ou NULL caso a data seja composta totalmente por 0 (zeros);
     *
     */
    public static function converteData($data) {
        if(self::valida_data($data)) {
            return implode(!strstr ($data, '/')  ? "/"   : "-", array_reverse(explode(!strstr ($data, '/')  ? "-"   : "/", $data)));
        } else {
            return "";
        }
    }
    
}