<?php
require_once './GDconnection.php';

function connectToDb() {
    $out;
    $out = new mysqli(DBSERVER, DBUSER, DBPASS, DBASE);
    return $out;
}

function geefOption($pWarehouse, $pSelectedWarehouse) {
//    echo $pWarehouse; 
//    echo $pSelectedWarehouse;
    if ($pWarehouse != $pSelectedWarehouse) {
        $eruit = "<option value=" . $pWarehouse . ">" . $pWarehouse . "</option>\n";
    } else {
        $eruit = "<option selected value = " . $pWarehouse . ">" . $pWarehouse . "</option>\n ";
    }
    return $eruit;
}

function oesLog($erinText) {
    $fh = fopen("oes.log", 'a+');
    fwrite($fh, date("F j, Y, g:i a"));
    fwrite($fh, $erinText . PHP_EOL);
    fclose($fh);
}

//function getSessionVariables() {
//    $item = $_SESSION['item'];
//    $desc = $_SESSION['desc'];
//    $stock = $_SESSION['stock'];
//    $minStock = $_SESSION['minStock'];
//    $maxStock = $_SESSION['maxStock'];
//    $warehouse = $_SESSION['warehouse'];
//}
//function setSessionVariables($erin){
//    $i=0;
//$_SESSION['item']       =  $erin[$i++]      ;
//$_SESSION['desc']       =  $erin[$i++]       ; 
//$_SESSION['stock']      =  $erin[$i++]      ;
//$_SESSION['minStock']   =  $erin[$i++]   ; 
//$_SESSION['maxStock']   =  $erin[$i++]   ;  
//$_SESSION['warehouse']  =  $erin[$i++]  ; 
//
//}
//function getOrderSessionVariables() {
//    $order = $_SESSION['order'];
//    $desc = $_SESSION['desc'];
//    $orderDate = $_SESSION['orderDate'];
//    $delDate = $_SESSION['delDate'];
//    $customer = $_SESSION['customer'];
//}
//
//function setOrderSessionVariables(array $erin){
//    var_dump($erin);
//    $i=0;
//$_SESSION['order']       =  $erin[$i++]      ;
//$_SESSION['desc']       =  $erin[$i++]       ; 
//$_SESSION['orderDate']      =  $erin[$i++]      ;
//$_SESSION['delDate']   =  $erin[$i++]   ; 
//$_SESSION['customer']   =  $erin[$i++]   ;  
//
//}
//
?>
