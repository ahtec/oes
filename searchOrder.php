<?php

session_start();
if (isset($_SESSION)) {
    if (isset($_SESSION['order'])) {
        $order = $_SESSION['order'];
    } else { {
            $order = 0;
        }
    }
}
require_once './connection.php';
require_once './model.php';

$conn = connectToDb();
$sql = "SELECT * FROM `order` WHERE 1 LIMIT 1 offset " . $_GET['orderSearch'];
$resultSet = $conn->query($sql);
$row = $resultSet->fetch_assoc();
$order = $row['order'];
$desc = $row['description'];
$orderDate = $row['orderDate'];
$delDate = $row['delDate'];
$customer = $row['customer'];

$objTransport = new order();
$objTransport->order = $order;
$objTransport->description = $desc;
$objTransport->orderDate = $orderDate;
$objTransport->delDate = $delDate;
$objTransport->customer = $customer;

echo json_encode($objTransport);

?>

