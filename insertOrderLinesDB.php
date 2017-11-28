<?php

session_start();
$order = $_SESSION['order'];
require_once './connection.php';
require_once './model.php';
echo "<br>";
$teverwerkenAantal = count($_REQUEST);
$teverwerkenAantal = $teverwerkenAantal / 2;
$errorText = "Changes are implemented";
$conn = connectToDb();
//var_dump($conn);
if ($conn->connect_error) {
    verwerkError(sprintf("Errormessage: %s\n", $conn->error));
}

for ($i = 1; $i <= $teverwerkenAantal; $i++) {
    $naamAantal = "aantal" . $i;
    $naamHiddenAantal = "hiddenaantal" . $i;
    $nieuwAantal = $_REQUEST[$naamAantal];
    $vorigAantal = $_REQUEST[$naamHiddenAantal];
    $verschil = $vorigAantal - $nieuwAantal;
    if ($verschil != 0) {
        echo "Er is een verschil van: " . $verschil . "op regel $i <br>";
        if ($nieuwAantal != 0 && $vorigAantal == 0) {
            insertInOrderLine($i, $order, $nieuwAantal);
        }

        if ($nieuwAantal != 0 && $vorigAantal != 0) {
            updateOrderline($i, $order, $nieuwAantal);
        }

        if ($nieuwAantal == 0 && $vorigAantal != 0) {
            deleteOrderLine($i, $order, $nieuwAantal);
        }
    }
}
$conn->close();
header("Location: insertOrderLines.php?errorText=$errorText ");

function deleteOrderLine($pItemTeller, $pOrder) {
    echo $pItemTeller;

    $zoekItem = converteerRijNummer2Item($pItemTeller);
    echo $zoekItem;
    $sql = sprintf("DELETE FROM `orderlines` WHERE `orderlines`.`order` = %d AND `orderlines`.`item` = %d", $pOrder, $zoekItem);
    echo $sql;
    echo "<br>";
    $conn = connectToDb();
    if (!$conn->query($sql)) {
        verwerkError(sprintf("Errormessage: %s\n", $conn->error));
    }
    $conn->close();
}

function updateOrderline($pItemTeller, $pOrder, $pAmoun) {
    $sql = sprintf("UPDATE `orderlines` SET `amount` = %d WHERE  `orderlines`.`order` = %d AND `orderlines`.`item` =  %d", $pAmount, $pOrder, converteerRijNummer2Item($pItemTeller));
    echo $sql;
    echo "<br>";
    $conn = connectToDb();
    if (!$conn->query($sql)) {
        verwerkError(sprintf("Errormessage: %s\n", $conn->error));
    }
}

function insertInOrderLine($pItemTeller, $pOrder, $pAmount) {
    $sql = sprintf("INSERT INTO `orderLines` ( `order`,  `item`, `amount`) VALUES ( %d, %d , %d)", $pOrder, converteerRijNummer2Item($pItemTeller, $conn), $pAmount);
    echo $sql;
    echo "<br>";
    $conn = connectToDb();
    if (!$conn->query($sql)) {
        verwerkError(sprintf("Errormessage: %s\n", $conn->error));
    }
}

function converteerRijNummer2Item($pItemTeller) {
    // zoek item mbv line nr
    $localItem = 0;
    $pItemTeller--;
//    $sql = "SELECT * FROM `item` WHERE 1 LIMIT 1 offset " . $pItemTeller;
    $sql = "SELECT * FROM `item` WHERE 1 LIMIT 1 offset " . $pItemTeller;
    echo $sql;
    $conn = connectToDb();
    $resultSet = $conn->query($sql);
    if (count($resultSet) != 0) {
        $row = $resultSet->fetch_assoc();
//        var_dump($row);
        $localItem = $row['item'];
    }
    return $localItem;
}

function verwerkError($pTxt) {
    global $errorText;
    $errorText = $pTxt;
}

function bestaatOrderLine($pZoekItem, $pOrder) {
    $sql = sprintf("SELECT * FROM `orderlines`   WHERE `orderlines`.`order` = %d AND `orderlines`.`item` = %d", $pOrder, $zoekItem);
    echo "<br>".$sql."<br>";
    $conn = connectToDb();
    $resultSet = $conn->query($sql);
    if (count($resultSet) != 0) {
        return true;
    } else {
        return false;
    }
}

?>