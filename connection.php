<?php
define('DBSERVER', "localhost"); // de databaseserver
define('DBUSER', "root");        // de gebruikersnaam waarmee we inloggen op de database
define('DBPASS', "");            // het wachtwoord waarmee we inloggen op de database
define('DBASE', "oes");          // de database waar onze tabellen in staan




function connectToDb()
{
    $out;
    $out = new mysqli(DBSERVER, DBUSER, DBPASS, DBASE);
    return $out;
}
//CREATE TABLE `oes`.`item` ( `item` INT(8) NOT NULL , `description` VARCHAR(30) NOT NULL , `stock` INT(8) NOT NULL , `minStock` INT(8) NOT NULL , `maxStock` INT(8) NOT NULL , `warehouse` VARCHAR(10) NOT NULL , `delTime` INT(8) NOT NULL , PRIMARY KEY (`item`)) ENGINE = InnoDB;




function getSessionVariables(){
$item      = $_SESSION['item'];
$desc      = $_SESSION['desc'];
$stock     = $_SESSION['stock'];
$minStock  = $_SESSION['minStock'];
$maxStock  = $_SESSION['maxStock'];
$warehouse = $_SESSION['warehouse'];

}

function setSessionVariables($erin){
    $i=0;
$_SESSION['item']       =  $erin[$i++]      ;
$_SESSION['desc']       =  $erin[$i++]       ; 
$_SESSION['stock']      =  $erin[$i++]      ;
$_SESSION['minStock']   =  $erin[$i++]   ; 
$_SESSION['maxStock']   =  $erin[$i++]   ;  
$_SESSION['warehouse']  =  $erin[$i++]  ; 

}




function getOrderSessionVariables(){
$order     = $_SESSION['order']      ;  
$desc      = $_SESSION['desc']    ; 
$orderDate = $_SESSION['orderDate'];
$delDate   = $_SESSION['delDate'] ; 
$customer  = $_SESSION['customer']; 

}

function setOrderSessionVariables(array $erin){
    var_dump($erin);
    $i=0;
$_SESSION['order']       =  $erin[$i++]      ;
$_SESSION['desc']       =  $erin[$i++]       ; 
$_SESSION['orderDate']      =  $erin[$i++]      ;
$_SESSION['delDate']   =  $erin[$i++]   ; 
$_SESSION['customer']   =  $erin[$i++]   ;  

}




  ?>
