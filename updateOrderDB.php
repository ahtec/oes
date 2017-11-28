<?php
session_start();
require_once './connection.php';
$returnText = "";

if (isset($_REQUEST)) {
    $order      =   $_REQUEST['order']      ;
    $desc       =   $_REQUEST['desc']       ;
    $orderDate  =   $_REQUEST['orderDate']  ;
    $delDate    =   $_REQUEST['delDate']    ;
    $customer   =   $_REQUEST['customer']   ;

    $_SESSION['order']      = $order    ;
    $_SESSION['desc']       = $desc     ;
    $_SESSION['orderDate']  = $orderDate;
    $_SESSION['delDate']    = $delDate  ;
    $_SESSION['customer']   = $customer ;
} else {
    $returnText = "error [102] Doorvoer gegevens niet correct <<updateOrderDB>>";
}
echo $_REQUEST['order'];
$conn = connectToDb();
if (!$conn->connect_error) {
    $sql = "UPDATE `order` SET "
            . "   `description` = '$desc'       "
            . " , `orderDate`   = '$orderDate'  "
            . " , `delDate`     = '$delDate'    "
            . " , `customer`    = '$customer'   "
            . "WHERE `order`.`order` = '$order' ";

//    echo $sql;
    if (!isset($_REQUEST['order'])) {
        $returnText = "error [100] order not set <<updateIrderDB>>";
    } else {
        $result = $conn->query($sql);
        if ($conn->connect_error) {
            echo "Error [409] in update update ging fout" . $conn->connect_error;
        }
        mysqli_close($conn);      
        $returnText = "Changes are implemented";
    }
} else {
    $returnText = "error [500] Connection error, see your database administrator <<updateOrderDB>>";
}
header("Location: maintainOrder.php?errorTxt=$returnText ");
?>

