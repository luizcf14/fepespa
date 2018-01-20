<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of autoloader
 *
 * @author luizcf14
 */
class autoloader {

    function autoloader() {
        spl_autoload_register(function ($class_name) {
            include $class_name . '.php';
        });
   }

}
