<?php

session_start();
$order = $_SESSION['order'];
require_once './connection.php';
require_once './model.php';
echo "<br>";
$teverwerkenAantal = count($_REQUEST);
$teverwerkenAantal = $teverwerkenAantal / 2;

$conn = connectToDb();
    if ($conn->connect_error) {
        printf("Errormessage: %s\n", $conn->error);
    }

for ($i = 1; $i <= $teverwerkenAantal; $i++) {
    $naamAantal         = "aantal" . $i;
    $naamHiddenAantal   = "hiddenaantal" . $i;
    $nieuwAantal        = $_REQUEST[$naamAantal];
    $verschil           = $_REQUEST[$naamHiddenAantal] - $_REQUEST[$naamAantal];
    if ($verschil != 0) {
        echo "Er is een verschil van: " .$verschil."<br>";
        if ($_REQUEST[$naamHiddenAantal] == 0) {
            insertInOrderLine($i, $order, $nieuwAantal,$conn);
        } else {
            updateOrderline($i, $order,$nieuwAantal,$conn);
        }
        if ($_REQUEST[$naamAantal] == 0) {
            deleteInOrderLine($i, $order, $nieuwAantal,$conn);
        }
    }
    
    
//    header("Location: insertOrderLines.php");

//    echo $_REQUEST[$naamAantal];
//    echo alsAantalVerschilt($order, $_REQUEST[$naamAantal], $i);
}

function updateOrderline($pItemTeller, $pOrder, $pAmount,$conn) {
//UPDATE `orderlines` SET `amount` = '55' WHERE `orderlines`.`order` = 7 AND `orderlines`.`item` = 1015;
    $sql = sprintf("UPDATE `orderlines` SET `amount` = %d WHERE  `orderlines`.`order` = %d AND `orderlines`.`item` =  %d",$pAmount ,$pOrder, converteerRijNummer2Item($pItemTeller,$conn) );
    echo $sql;

    if (!$conn->query($sql)) {
        printf("Errormessage: %s\n", $conn->error);
    }
}

function insertInOrderLine($pItemTeller, $pOrder, $pAmount,$conn) {

    $sql = sprintf("INSERT INTO `orderLines` ( `order`,  `item`, `amount`) VALUES ( %d, %d , %d)", $pOrder, converteerRijNummer2Item($pItemTeller,$conn), $pAmount);
    echo $sql;

    if (!$conn->query($sql)) {
        printf("Errormessage: %s\n", $conn->error);
    }
}

function converteerRijNummer2Item($pItemTeller,$conn) {
    // zoek item mbv line nr
    $localItem = 0;

        $pItemTeller--;
        $sql = "SELECT * FROM `item` WHERE 1 LIMIT 1 offset " . $pItemTeller;
        echo $sql;
        $resultSet = $conn->query($sql);
        if (count($resultSet) != 0) {
            $row = $resultSet->fetch_assoc();
            var_dump($row);
            $localItem = $row['item'];
        }

    return $localItem;
}




function alsAantalVerschilt($aantal, $itemTeller,$conn) {
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