<?php
session_start(); ob_start();
error_reporting(E_ALL);

try{
    $con = new PDO('mysql:host=localhost;dbname=cuebar_cuebar','cuebar_cuebar','RuPzTrgVthMe');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo 'Err: Status: '. $e->getMessage();
}


# CONSTANT VARIABLES
define('XDATE', date('d/m/Y'));
// $urlNm=basename($_SERVER['HTTPS']);
?>