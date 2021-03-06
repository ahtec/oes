<?php
session_start();
$item      = $_SESSION['item'];
$desc      = $_SESSION['desc'];
$stock     = $_SESSION['stock'];
$minStock  = $_SESSION['minStock'];
$maxStock  = $_SESSION['maxStock'];
$warehouse = $_SESSION['warehouse'];
require_once './connection.php';
require_once './model.php';

$conn = connectToDb();

$sql = "SELECT * FROM `item` WHERE 1 LIMIT 1 offset " . $_GET['itemSearch'];

$resultSet = $conn->query($sql);
$row       = $resultSet->fetch_assoc();
$item      = $row['item'];
$desc      = $row['description'];
$stock     = $row['stock'];
$minStock  = $row['minStock'];
$maxStock  = $row['maxStock'];
$warehouse = $row['warehouse'];

$_SESSION['item']      = $row['item'];
$_SESSION['desc']      = $row['description'];
$_SESSION['stock']     = $row['stock'];
$_SESSION['minStock']  = $row['minStock'];
$_SESSION['maxStock']  = $row['maxStock'];
$_SESSION['warehouse'] = $row['warehouse'];

$objTransportItem = new item();

$objTransportItem->item        = $item;
$objTransportItem->description = $desc;
$objTransportItem->stock       = $stock;
$objTransportItem->minStock    = $minStock;
$objTransportItem->maxStock    = $maxStock;
$objTransportItem->warehouse   = $warehouse;

echo json_encode($objTransportItem);
?>

