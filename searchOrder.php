<?php

session_start();
if (isset($_SESSION)){
    if (isset($_SESSION['order'])){
     $order      = $_SESSION['order'];   
    } else {
        
    {
        $order = 0;
    }
   
    }
}
//$desc       = $_SESSION['desc'];
//$orderDate  = $_SESSION['orderDate'];
//$delDate    = $_SESSION['delDate'];
//$customer   = $_SESSION['customer'];
require_once './connection.php';
require_once './model.php';

//getSessionVariables();


$conn = connectToDb();

$sql = "SELECT * FROM `order` WHERE 1 LIMIT 1 offset " . $_GET['orderSearch'];
//echo $sql;
$resultSet = $conn->query($sql);

$row = $resultSet->fetch_assoc();  
//var_dump($row);
$order     = $row['order']      ;
$desc      = $row['description']; 
$orderDate = $row['orderDate']  ;
$delDate   = $row['delDate']    ; 
$customer  = $row['customer']   ; 


//var_dump($item     )  ;
//var_dump($desc     )  ;
//var_dump($stock    )  ;
//var_dump($minStock )  ;
//var_dump($maxStock )  ;
//var_dump($warehouse)  ;
//

//$i=0;
//$_SESSION['item']       =  $row['item']          ;
//$_SESSION['desc']       =  $row['description']   ; 
//$_SESSION['stock']      =  $row['stock']         ;
//$_SESSION['minStock']   =  $row['minStock']      ; 
//$_SESSION['maxStock']   =  $row['maxStock']      ;  
//$_SESSION['warehouse']  =  $row['warehouse']     ; 
////echo $row['item'] ;
//var_dump($_SESSION);

$objTransport               =  new order()  ;
$objTransport->order        =   $order      ;
$objTransport->description  =   $desc       ;
$objTransport->orderDate    =   $orderDate  ;
$objTransport->delDate      =   $delDate    ;
$objTransport->customer     =   $customer   ;

//var_dump($objTransportItem);
//        $row['item']        ,
//        $row['description'] , 
//        $row['stock']       , 
//        $row['minStock']    ,
//        $row['maxStock']    ,
//        $row['warehouse']     );
//        
        
echo json_encode($objTransport);        
//        
//
//echo $row['item']       ;
//echo $row['description'] ;
//echo $row['stock']       ;
//setSessionVariables($row);


//$sql = "SELECT * FROM `elftal` WHERE `naam` LIKE '%".$_GET['itemSearch']."%';";  
?>

