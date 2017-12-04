<?php

session_start();

require_once './connection.php';
$returnText = "";

if (isset($_REQUEST)) {
    $desc      = $_REQUEST['desc'];
    $orderDate = $_REQUEST['orderDate'];
    $delDate   = $_REQUEST['delDate'];
    $customer  = $_REQUEST['customer'];

    $_SESSION['desc']      = $desc;
    $_SESSION['orderDate'] = $orderDate;
    $_SESSION['delDate']   = $delDate;
    $_SESSION['customer']  = $customer;
} else {
    $returnText = "error [100] Doorvoer gegevens niet correct <<insertItemDB>>";
}

$conn = connectToDb();
if (!$conn->connect_error) {
    $sql    = "INSERT INTO `order` "
            . "( `description`, `orderDate`, `delDate`, `customer`) "
            . "VALUES ( '$desc', '$orderDate',  '$delDate', '$customer')";
    echo $sql;
    $result = $conn->query($sql);

    if ($conn->connect_error) {
        echo "insert ging fout" . $conn->connect_error;
    } else {
        $sql    = "SELECT MAX(`order`) FROM `order` ";
        echo $sql;
        echo "<br>";
        $result = $conn->query($sql);

        $row               = mysqli_fetch_array($result);
        $_SESSION['order'] = $row[0];
    }
    mysqli_close($conn);
    header("Location: displayOrder.php");
} else {
    $returnText = "error [500] Connection error, see your database administrator <<insertItemDB>>";
    header("Location: insertOrder.php?errorTxt=$returnText ");
}
?>

