<?php

ob_start();
session_start();
$module = isset($_GET['module']) ? $_GET['module'] : '';

switch ($module) {

    case 'carteirinha':
        require('pdf/fpdf/carteirinha.php');
        break;
}