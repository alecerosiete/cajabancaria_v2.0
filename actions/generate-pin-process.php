<?php
    require '../inc/sql-functions.php';
    //sleep(2);
    
    $long = $_POST['longitud'];
    $caracteres='0123456789';
    $longpalabra=$long;
    for($pin='', $n=strlen($caracteres)-1; strlen($pin) < $longpalabra ; ) {
      $x = rand(0,$n);
      $pin.= $caracteres[$x];
    }
    
    $html = "<div class='alert alert-info' style='font-family:16px;margin-top:10px;width:200px;margin-bottom:-20px'>";
    $html .= $pin;
    $html .= "</div>";
    
    echo $html;