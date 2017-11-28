<?php

session_start();
$order = $_SESSION['order'];
require_once './connection.php';
require_once './model.php';
echo "<br>";
$teverwerkenAantal = count($_REQUEST);
$teverwerkenAantal = $teverwerkenAantal / 2;



for ($i = 1; $i <= $teverwerkenAantal; $i++) {
    $naamAantal = "aantal" . $i;
    $hiddenAantal = "hiddenaantal" . $i;

    $verschil = $_REQUEST[$hiddenAantal] - $_REQUEST[$naamAantal];
    if ($verschil != 0) {
        echo "Er is een verschil";
        echo $verschil;
        echo "<br>";
        if($_REQUEST[$hiddenAantal]  == 0   ) {
            echo "aantal was 0"; 
            echo " in I=".$i;
            // insteretn in orderline
            insertInOrderLine($i,$order,$naamAantal);
        }  else {
            //uopdaten orderline
            updateOrderline($i,$order);
            
        }
    }

//    echo $_REQUEST[$naamAantal];
//    echo alsAantalVerschilt($order, $_REQUEST[$naamAantal], $i);
}






function insertInOrderLine( $pItemTeller , $pOrder, $pAmount) {

    
    // zoek item mbv line nr
    
    $conn = connectToDb();
$itemTeller--;
$sql = "SELECT * FROM `item` WHERE 1 LIMIT 1 offset " .$pItemTeller;
echo $sql;
$resultSet = $conn->query($sql);
$row = $resultSet->fetch_assoc();  
var_dump($row);
$localItem      = $row['item']         ;

echo $localItem;


if (!$conn->connect_error) {
    $sql = "INSERT INTO `orderLines` "
                    . "( `order`, `line`, `item`, `amount`) "
            . "VALUES ( $order, 1 , $localItem, $maxStock, '$warehouse')";
    echo $sql;
    $result = $conn->query($sql);

    
    
    
}

    
    
    
}
function alsAantalVerschilt($aantal, $itemTeller) {
//    
//    $aantal = 0;
//    $conn = connectToDb();
//    $sql = sprintf("SELECT * FROM  `orderLines`  where  `order` = %d   and `item` = %d ", $pOrder, $pItem);
//    echo $sql;
//    $result = mysqli_query($conn, $sql);
//     while ($row = mysqli_fetch_array($result)) {
//         echo $row['item'];
//         $aantal = $row['amount'];
//     } 
    echo $$aantal;
}

?>