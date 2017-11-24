<?php
session_start();

require_once './connection.php';
$returnText = "";

if (isset($_REQUEST)) {
    $desc = $_REQUEST['desc'];
    $stock = $_REQUEST['stock'];
    $minStock = $_REQUEST['minStock'];
    $maxStock = $_REQUEST['maxStock'];
    $warehouse = $_REQUEST['warehouse'];

    $_SESSION['desc'] = $desc;
    $_SESSION['stock'] = $stock;
    $_SESSION['minStock'] = $minStock;
    $_SESSION['maxStock'] = $maxStock;
    $_SESSION['warehouse'] = $warehouse;
} else {
    $returnText = "error [100] Doorvoer gegevens niet correct <<insertItemDB>>";
}

$conn = connectToDb();
if (!$conn->connect_error) {
//          UPDATE `item` SET `description` = 'nummer999' WHERE `item`.`item` = 999
    $sql = "UPDATE `item` SET "
            . "`description`  = '$desc'       "
            . " , `stock`     = '$stock'      "
            . " , `minStock ` = '$minStock'   " 
            . " , `maxStock`  = '$maxStock'   " 
            . " , `warehouse` = '$warehouse') ";
           
            echo $sql;
    $result = $conn->query($sql);

    if ($conn->connect_error) {
        echo "insert ging fout" . $conn->connect_error;
    } 

    mysqli_close($conn);        // sluit de connectie
    header("Location: displayItem.php");
} else {
    $returnText = "error [500] Connection error, see your database administrator <<insertItemDB>>";
    header("Location: insertItem.php?errorTxt=$returnText ");
}
?>

