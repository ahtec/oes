<?php
session_start();
$order =  $_SESSION['order'];

echo "<br>";
//var_dump($_SESSION);

//  http://localhost/oes/insertOrderLinesDB.php?  aantal1=0& aantal2=13&aantal3=0&aantal4=0&aantal5=0
//echo count($_REQUEST);
$teverwerkenAantal = count($_REQUEST);
for ($i = 1 ;$i <= $teverwerkenAantal ;$i++){
 $naamAantal = "aantal".$i;
    echo $_REQUEST[$naamAantal];
    alsAantalVerschild($order, $_REQUEST[$naamAantal,$i );
    
    
}
//        $conn = connectToDb();
//        $sql = sprintf("SELECT * FROM  `orderLines`  where  `order` = %d   and `item` = %d ", $pOrder, $pItem);
//        echo $sql;
//        $result = mysqli_query($conn, $sql);





function alsAantalVerschild($order, $aantal, $itemTeller){
    
    
    
    
    
}

?>