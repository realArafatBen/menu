<?php 
 include_once('../inc/conn.php');
 include_once('../inc/functions.php');

if(isset($_POST['id'])){
    if (isset($_COOKIE['menu_love'])) {
        $cookie_data = stripcslashes($_COOKIE['menu_love']);
        $data = json_decode($cookie_data, true);
        
    }else{
        $data = [];
    }

    
    if (in_array($_POST['id'], $data) ) {
        $key = array_search($_POST['id'], $data);
        unset($data[$key]);
    }

    $json_data = json_encode($data);
    setcookie('menu_love',$json_data,time()+300*24*60*60,"/");

}
?>