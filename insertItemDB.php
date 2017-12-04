<?php
session_start();
require_once './connection.php';
$returnText = "";

if (isset($_REQUEST)) {
    $desc      = $_REQUEST['desc'];
    $stock     = $_REQUEST['stock'];
    $minStock  = $_REQUEST['minStock'];
    $maxStock  = $_REQUEST['maxStock'];
    $warehouse = $_REQUEST['warehouse'];

    $_SESSION['desc']      = $desc;
    $_SESSION['stock']     = $stock;
    $_SESSION['minStock']  = $minStock;
    $_SESSION['maxStock']  = $maxStock;
    $_SESSION['warehouse'] = $warehouse;
} else {
    $returnText = "error [100] Doorvoer gegevens niet correct <<insertItemDB>>";
}
$conn = connectToDb();
if (!$conn->connect_error) {
    $sql    = "INSERT INTO `item` "
            . "( `description`, `stock`, `minStock`, `maxStock`, `warehouse`) "
            . "VALUES ( '$desc', $stock, $minStock, $maxStock, '$warehouse')";
    echo $sql;
    $result = $conn->query($sql);

    if ($conn->connect_error) {
        echo "insert ging fout" . $conn->connect_error;
    } else {
        $sql              = "SELECT MAX(`item`) FROM `item` ";
        echo $sql;
        echo "<br>";
        $result           = $conn->query($sql);
        $row              = mysqli_fetch_array($result);
        echo $row[0];
        $_SESSION['item'] = $row[0];
    }
    mysqli_close($conn);        
    header("Location: displayItem.php");
} else {
    $returnText = "error [500 49] Connection error, see your database administrator <<insertItemDB>>";
    header("Location: insertItem.php?errorTxt=$returnText ");
}
?>

