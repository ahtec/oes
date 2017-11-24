<?php

session_start();
$item      = $_SESSION['item'];
$desc      = $_SESSION['desc'];
$stock     = $_SESSION['stock'];
$minStock  = $_SESSION['minStock'];
$maxStock  = $_SESSION['maxStock'];
$warehouse = $_SESSION['warehouse'];
require_once './connection.php';
require_once './item.php';

//getSessionVariables();


$conn = connectToDb();

$sql = "SELECT * FROM `item` WHERE 1 LIMIT 1 offset " . $_GET['itemSearch'];
//echo $sql;
$resultSet = $conn->query($sql);

$row = $resultSet->fetch_assoc();  // Get the next record AS an array into the variable row
//var_dump($row);
$item      = $row['item']         ;
$desc      = $row['description']  ; 
$stock     = $row['stock']        ;
$minStock  = $row['minStock']     ; 
$maxStock  = $row['maxStock']     ; 
$warehouse = $row['warehouse']    ; 
//var_dump($item     )  ;
//var_dump($desc     )  ;
//var_dump($stock    )  ;
//var_dump($minStock )  ;
//var_dump($maxStock )  ;
//var_dump($warehouse)  ;
//

//$i=0;
$_SESSION['item']       =  $row['item']          ;
$_SESSION['desc']       =  $row['description']   ; 
$_SESSION['stock']      =  $row['stock']         ;
$_SESSION['minStock']   =  $row['minStock']      ; 
$_SESSION['maxStock']   =  $row['maxStock']      ;  
$_SESSION['warehouse']  =  $row['warehouse']     ; 
//echo $row['item'] ;
//var_dump($_SESSION);

$objTransportItem =  new item();

$objTransportItem->item         =   $item       ;
$objTransportItem->description  =   $desc       ;
$objTransportItem->stock        =   $stock      ;
$objTransportItem->minStock     =   $minStock   ;
$objTransportItem->maxStock     =   $maxStock   ;
//$objTransportItem->warehouse    =   $warehouse ;
//var_dump($objTransportItem);
        
        
        
        
        
//        $row['item']        ,
//        $row['description'] , 
//        $row['stock']       , 
//        $row['minStock']    ,
//        $row['maxStock']    ,
//        $row['warehouse']     );
//        
        
echo json_encode($objTransportItem);        
//        
//
//echo $row['item']       ;
//echo $row['description'] ;
//echo $row['stock']       ;
//setSessionVariables($row);


//$sql = "SELECT * FROM `elftal` WHERE `naam` LIKE '%".$_GET['itemSearch']."%';";  
?>

