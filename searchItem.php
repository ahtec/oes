<?php

session_start();
//$item       = $_SESSION['item'];
//$desc      = $_SESSION['desc'];
//$stock     = $_SESSION['stock'];
//$minStock  = $_SESSION['minStock'];
//$maxStock  = $_SESSION['maxStock'];
//$warehouse = $_SESSION['warehouse'];
require_once './connection.php';
getSessionVariables();


$conn = connectToDb();

$sql = "SELECT * FROM `item` WHERE 1 LIMIT 1 offset " . $_GET['itemSearch'];
//echo $sql;
$resultSet = $conn->query($sql);
$row = $resultSet->fetch_assoc();  // Get the next record AS an array into the variable row
$i=0;
$_SESSION['item']       =  $row['item']      ;
$_SESSION['desc']       =  $row['description']       ; 
$_SESSION['stock']      =  $row['stock']      ;
//$_SESSION['minStock']   =  $erin[$i++]   ; 
//$_SESSION['maxStock']   =  $erin[$i++]   ;  
//$_SESSION['warehouse']  =  $erin[$i++]  ; 
//echo $row['item'] ;
echo $row['item'] ;
echo $row['description'] ;
echo $row['stock']  ;
//setSessionVariables($row);





//$sql = "SELECT * FROM `elftal` WHERE `naam` LIKE '%".$_GET['itemSearch']."%';";  
?>

