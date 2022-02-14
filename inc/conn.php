<?php
session_start(); ob_start();
error_reporting(E_ALL);

try{
    $con = new PDO('mysql:host=localhost;dbname=caledoni_menu','caledoni_ansuite','caledoni_ansuites');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo 'Err: Status: '. $e->getMessage();
}


# CONSTANT VARIABLES
define('XDATE', date('d/m/Y'));
// $urlNm=basename($_SERVER['HTTPS']);
?>