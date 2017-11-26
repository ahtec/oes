<?php

session_start();

require_once './connection.php';
$returnText = "";
//var_dump($_REQUEST);

if (isset($_REQUEST)) {
    $item = $_REQUEST['item'];
    $desc = $_REQUEST['desc'];
    $stock = $_REQUEST['stock'];
    $minStock = $_REQUEST['minStock'];
    $maxStock = $_REQUEST['maxStock'];
    $warehouse = $_REQUEST['warehouse'];

    $_SESSION['item'] = $item;
    $_SESSION['desc'] = $desc;
    $_SESSION['stock'] = $stock;
    $_SESSION['minStock'] = $minStock;
    $_SESSION['maxStock'] = $maxStock;
    $_SESSION['warehouse'] = $warehouse;
} else {
    $returnText = "error [101] Doorvoer gegevens niet correct <<updateItemDB>>";
}
echo "item:";
echo $item;
echo "en nu ";
echo $_REQUEST['item'];
$conn = connectToDb();
if (!$conn->connect_error) {
//          UPDATE `item` SET `description` = 'nummer999' WHERE `item`.`item` = 999
    $sql = "UPDATE `item` SET "
            . "`description`  = '$desc'       "
            . " , `stock`     = '$stock'      "
            . " , `minStock`  = '$minStock'   "
            . " , `maxStock`  = '$maxStock'   "
            . " , `warehouse` = '$warehouse'  "
            . "WHERE `item`.`item` = '$item' ";

//    echo $sql;
    if (!isset($_REQUEST['item'])) {
        $returnText = "error [100] Item not set <<updateItemDB>>";
    } else {
        $result = $conn->query($sql);
        if ($conn->connect_error) {
            echo "Error [409] in update update ging fout" . $conn->connect_error;
        }
        mysqli_close($conn);        // sluit de connectie

        $returnText = "Changes are implemented ";
    }
} else {
    $returnText = "error [500] Connection error, see your database administrator <<updateItemDB>>";
}

header("Location: maintainItem.php?errorTxt=$returnText ");
?>

